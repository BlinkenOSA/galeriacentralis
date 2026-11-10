<?php

namespace Tests\Feature;

use A17\Twill\Models\User;
use A17\Twill\Models\Media;
use App\Models\Category;
use App\Models\Event;
use App\Models\Option;
use App\Models\Page;
use App\Models\PressItem;
use App\Repositories\EventRepository;
use App\Repositories\OptionRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class UpgradeCompatibilityTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
        $fields = array_fill_keys(['instagram', 'facebook', 'twitter', 'youtube', 'phone', 'fax', 'email'], '');
        foreach (['hours', 'address', 'programs', 'about', 'impressum', 'metatitle', 'metadescription'] as $field) {
            $fields[$field] = ['en' => 'Galeria', 'hu' => 'Galéria'];
        }
        Option::create(['published' => true, 'options' => json_encode($fields)]);
    }

    public function test_public_pages_render_in_both_languages(): void
    {
        foreach (['/', '/hu', '/info', '/hu/informacio', '/press', '/hu/sajto'] as $url) {
            $this->get($url)->assertOk();
        }
    }

    public function test_existing_table_names_and_admin_urls_are_preserved(): void
    {
        foreach (['blocks', 'medias', 'mediables', 'files', 'fileables', 'tags', 'tagged', 'twill_users'] as $table) {
            $this->assertTrue(Schema::hasTable($table), $table);
        }
        $this->assertFalse(Schema::hasTable('twill_medias'));
        $this->get('/manage/login')->assertOk();
        $this->withExceptionHandling()->get('/manage/events/events')->assertRedirect('/manage/login');
    }

    public function test_existing_event_dates_and_translations_remain_usable(): void
    {
        $event = app(EventRepository::class)->create([
            'published' => true,
            'title' => ['en' => 'Exhibition', 'hu' => 'Kiállítás'],
            'languages' => [['value' => 'en', 'published' => true], ['value' => 'hu', 'published' => true]],
            'start' => '2026-10-01',
            'end' => '2026-11-01',
        ]);
        $this->assertSame(2026, $event->fresh()->start->year);
        $this->assertSame('Kiállítás', $event->fresh()->translate('hu')->title);
        $this->assertNotEmpty($event->slugs);
        $press = new PressItem(['date' => '2026-10-26']);
        $this->assertSame('2026-10-26', $press->date->toDateString());
    }

    public function test_admin_module_forms_render_on_twill_three(): void
    {
        $user = User::create(['name' => 'Editor', 'email' => 'editor@example.test', 'role' => 'SUPERADMIN', 'published' => true]);
        $this->actingAs($user, 'twill_users');
        $this->get(route('twill.events.events.index'))->assertOk();
        $this->get(route('twill.events.categories.index'))->assertOk();
        $this->followingRedirects()->get(route('twill.options.show', ['option' => 1]))->assertOk();
    }

    public function test_event_gallery_photos_can_be_saved_and_reloaded(): void
    {
        $repository = app(EventRepository::class);
        $event = $repository->create([
            'title' => ['en' => 'Gallery exhibition'],
            'languages' => [['value' => 'en', 'published' => true]],
        ]);
        $photo = Media::create([
            'uuid' => 'gallery-test/photo.jpg',
            'filename' => 'photo.jpg',
            'width' => 1200,
            'height' => 800,
        ]);

        // Newly attached photos can arrive without explicit crop coordinates.
        $repository->update($event->id, ['medias' => ['images' => [[
            'id' => $photo->id,
            'metadatas' => ['custom' => ['caption' => 'Exhibition opening']],
        ]]]]);

        $savedEvent = $event->fresh();
        $this->assertTrue($savedEvent->hasImage('images'));
        $this->assertCount(1, $savedEvent->medias);
        $savedPhoto = $savedEvent->medias->first();
        $this->assertSame($photo->id, $savedPhoto->id);
        $this->assertSame('default', $savedPhoto->pivot->crop);
        $this->assertSame('free', $savedPhoto->pivot->ratio);
        $this->assertNull($savedPhoto->pivot->crop_w);
        $this->assertSame('Exhibition opening', $savedEvent->imageCaption('images'));

        $fields = $repository->getFormFields($savedEvent);
        $gallery = $fields['medias']['images'];
        $this->assertSame($photo->id, $gallery[0]['id']);
        $this->assertSame('free', $gallery[0]['crops']['default']['name']);

        // Saving the reloaded form must keep the photo and its metadata.
        $repository->update($event->id, ['medias' => ['images' => $gallery]]);
        $this->assertCount(1, $event->fresh()->medias);
        $this->assertSame('Exhibition opening', $event->fresh()->imageCaption('images'));

        $repository->update($event->id, ['medias' => ['images' => []]]);
        $this->assertFalse($event->fresh()->hasImage('images'));
    }

    public function test_options_can_be_saved_with_legacy_grouped_fields(): void
    {
        $repository = app(OptionRepository::class);
        $repository->update(1, ['email' => 'galeria@example.test', 'hours' => ['en' => 'Open daily', 'hu' => 'Nyitva minden nap']]);
        $options = Option::findOrFail(1);
        $this->assertSame('galeria@example.test', $options->fields['email']);
        $this->assertSame('Open daily', $repository->getFormFields($options)['hours']['en']);
    }
    public function test_category_and_page_routes_work_without_database_queries_during_boot(): void
    {
        $category = Category::create(['published' => true, 'en' => ['title' => 'Exhibitions', 'active' => true], 'hu' => ['title' => 'Kiállítások', 'active' => true]]);
        $category->slugs()->forceCreate(['slug' => 'exhibitions', 'locale' => 'en', 'active' => true]);
        $category->slugs()->forceCreate(['slug' => 'kiallitasok', 'locale' => 'hu', 'active' => true]);
        $event = Event::create(['published' => true, 'start' => now()->subDay(), 'end' => now()->addDay(), 'en' => ['title' => 'Exhibition', 'active' => true], 'hu' => ['title' => 'Kiállítás', 'active' => true]]);
        $event->categories()->attach($category);
        $event->slugs()->forceCreate(['slug' => 'exhibition', 'locale' => 'en', 'active' => true]);
        $event->slugs()->forceCreate(['slug' => 'kiallitas', 'locale' => 'hu', 'active' => true]);
        $this->get('/')->assertOk()->assertSee('Exhibition');
        $this->get('/exhibitions')->assertOk()->assertSee('Exhibition');
        $this->get('/exhibitions/exhibition')->assertOk()->assertSee('Exhibition');

        $page = Page::create(['published' => true, 'en' => ['title' => 'Visit', 'active' => true]]);
        $page->slugs()->forceCreate(['slug' => 'visit', 'locale' => 'en', 'active' => true]);
        $page->blocks()->create(['position' => 1, 'type' => 'text', 'editor_name' => 'default', 'content' => ['body' => ['en' => '<p>Visit Galeria</p>']]]);
        $this->get('/visit')->assertOk()->assertSee('Visit Galeria');
        $this->get('/hu/kiallitasok')->assertOk()->assertSee('Kiállítás');
    }

}
