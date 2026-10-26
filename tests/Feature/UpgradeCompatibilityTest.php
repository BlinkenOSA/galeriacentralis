<?php

namespace Tests\Feature;

use A17\Twill\Models\User;
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

    public function test_homepage_falls_back_to_latest_published_exhibition_in_both_languages(): void
    {
        $this->createHomepageEvent('Older exhibition', -20, -10);
        $latest = $this->createHomepageEvent('Latest exhibition', -15, -5);
        $this->createHomepageEvent('Recent talk', -3, -2, [], 'events');
        $this->createHomepageEvent('Unpublished exhibition', -3, -1, ['published' => false]);
        $this->createHomepageEvent('Hidden exhibition', -3, -1, ['monoscope' => 1]);

        $this->get('/')->assertOk()->assertViewIs('frontpage.event')
            ->assertViewHas('event', fn ($event) => $event->id === $latest->id)
            ->assertSee('Latest exhibition');
        $this->get('/hu')->assertOk()->assertViewIs('frontpage.event')
            ->assertViewHas('event', fn ($event) => $event->id === $latest->id)
            ->assertSee('Latest exhibition HU');
    }

    public function test_current_event_takes_priority_over_the_homepage_fallback(): void
    {
        $this->createHomepageEvent('Past exhibition', -10, -5);
        $current = $this->createHomepageEvent('Current exhibition', -1, 1);

        $this->get('/')->assertOk()->assertViewIs('frontpage.event')
            ->assertViewHas('event', fn ($event) => $event->id === $current->id);
    }

    public function test_upcoming_event_keeps_its_existing_homepage_preview(): void
    {
        $this->createHomepageEvent('Past exhibition', -10, -5);
        $upcoming = $this->createHomepageEvent('Upcoming exhibition', 1, 5);

        $this->get('/')->assertOk()->assertViewIs('frontpage.empty')
            ->assertViewHas('event', fn ($event) => $event->id === $upcoming->id)
            ->assertSee('Upcoming exhibition');
    }

    public function test_maintenance_mode_keeps_the_monoscope_instead_of_the_fallback(): void
    {
        $this->createHomepageEvent('Past exhibition', -10, -5);
        $options = Option::firstOrFail();
        $options->update(['options' => json_encode(array_merge($options->fields, ['maintenance' => true]))]);

        $this->get('/')->assertOk()->assertViewIs('frontpage.empty')
            ->assertDontSee('Past exhibition');
    }

    public function test_homepage_stays_empty_without_an_eligible_exhibition(): void
    {
        $this->createHomepageEvent('Past talk', -3, -2, [], 'events');
        $this->createHomepageEvent('Unpublished exhibition', -3, -1, ['published' => false]);
        $this->createHomepageEvent('Hidden exhibition', -3, -1, ['monoscope' => 1]);

        $this->get('/')->assertOk()->assertViewIs('frontpage.empty');
    }

    private function createHomepageEvent(string $title, int $startDays, int $endDays, array $attributes = [], string $categorySlug = 'exhibitions'): Event
    {
        $category = Category::whereHas('slugs', fn ($query) => $query->where('slug', $categorySlug))->first();
        if (!$category) {
            $category = Category::create([
                'published' => true,
                'en' => ['title' => ucfirst($categorySlug), 'active' => true],
                'hu' => ['title' => ucfirst($categorySlug), 'active' => true],
            ]);
            foreach (['en', 'hu'] as $locale) {
                $category->slugs()->forceCreate(['slug' => $categorySlug, 'locale' => $locale, 'active' => true]);
            }
        }

        $event = Event::create(array_merge([
            'published' => true,
            'start' => now()->addDays($startDays)->toDateString(),
            'end' => now()->addDays($endDays)->toDateString(),
            'en' => ['title' => $title, 'active' => true],
            'hu' => ['title' => $title . ' HU', 'active' => true],
        ], $attributes));
        $event->categories()->attach($category);
        foreach (['en', 'hu'] as $locale) {
            $event->slugs()->forceCreate(['slug' => \Illuminate\Support\Str::slug($title), 'locale' => $locale, 'active' => true]);
        }

        return $event;
    }
}
