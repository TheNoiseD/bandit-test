<?php

namespace Tests\Feature;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Request;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;

class AppTest extends TestCase
{
    use RefreshDatabase;

    public $user;
    public $password;

    public function setUp() : void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'name' => 'John',
            'email' => 'test@gmail.com',
            'password' => bcrypt('i-love-laravel'),
        ]);
        $this->password = 'i-love-laravel';
    }

    public function test_can_a_user_enter_home_and_see_the_form()
    {
        $this->withExceptionHandling();
        $response = $this->get('/');
        $response->assertViewIs('home');
        $response->assertStatus(200);
        $response->assertSee('Bienvenido, busquemos una actividad');
    }

    public function test_can_a_user_search_activities_with_the_form()
    {
        $this->withExceptionHandling();
        $fecha = '2022-12-25';
        $participantes = 2;
        Activity::factory()->count(10)->create();
        $actividades = Activity::search($fecha);
        $response = $this->get('activities/search?date=' . $fecha . '&participants=' . $participantes)->assertOk();
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'title',
                    'price',
                    'action'
                ]
            ]
        ]);
    }

    public function test_can_make_a_request_ajax_for_activities()
    {
        $this->withExceptionHandling();
        Activity::factory()->count(10)->create();
        $response = $this->get('activities', ['HTTP_X-Requested-With' => 'XMLHttpRequest']);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'title',
                    'description',
                    'price',
                    'start_date',
                    'end_date',
                    'action'
                ]
            ]
        ]);
        $response->assertOk();
    }

    public function test_can_a_user_see_the_activities_list_page()
    {
        $this->withExceptionHandling();
        Activity::factory()->count(10)->create();
        $response = $this->get('activities');
        $response->assertViewIs('activities.index');
        $response->assertStatus(200);
        $response->assertSee('Actividades');
    }

    public function test_can_a_user_see_the_activity_details()
    {
        $this->withExceptionHandling();
        $activity = Activity::factory()->create();
        $response = $this->get('activities/' . $activity->id)->assertOk();
        $response->assertViewIs('activities.show');
        $response->assertViewHas('activity');
        $response->assertStatus(200);
        $response->assertSee($activity->title);
    }

    public function test_can_a_user_purchase_an_activity()
    {
        $this->withExceptionHandling();
        $activity = Activity::factory()->create();
        $this->actingAs($this->user);
        $this->post('reserve', [
            'activity_id' => $activity->id,
            'participants' => 2,
            'date' => '2022-12-25',
            'user_id'=> $this->user->id,
        ])->assertRedirectToRoute('reserve.index');
    }

}
