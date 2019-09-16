<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubmissionsTest extends TestCase
{

    use WithFaker;
    // use RefreshDatabase;

    /** @test */
    public function guests_can_apply() 
    {
        // $this->withoutExceptionHandling();
        $submission = factory('App\Submission')->raw();

        $this->post("/", $submission); 
        $this->assertDatabaseHas("submissions", $submission);
    }

    /** @test */
    public function only_authenticated_users_can_access_admin_dashboard()
    {
        // $this->withoutExceptionHandling();
        $this->signIn();
        $this->get('/admin')->assertStatus(200);
    }

    /** @test */
    public function guests_cannot_access_admin_dashboard() 
    {
        // $this->withoutExceptionHandling();
        $this->get('/admin')->assertRedirect('login');
    }

    /** @test */
    public function guests_cannot_view_a_submission()
    {   
        $submission = factory('App\Submission')->create();
        $this->get($submission->path())->assertRedirect('login');
    }

    /** @test */
    public function guests_cannot_edit_a_submission()
    {   
        $submission = factory('App\Submission')->create();
        $this->get($submission->path() . '/edit')->assertRedirect('login');
    }

    /** @test */
    public function guests_cannot_delete_a_submission()
    {   
        $submission = factory('App\Submission')->create();
        $this->delete($submission->path())->assertRedirect('login');
    }

    /** @test */
    public function authenticated_users_can_export_json_file() 
    {   
        // $this->withoutExceptionHandling();
        $this->signIn();
        $this->get('/export')
            ->assertStatus(200)
            ->assertSuccessful();
    }

     /** @test */
     public function guests_cannot_export_json_file() 
     {   
         // $this->withoutExceptionHandling();
         $this->get('/export')->assertRedirect('login');
     }
    
}
