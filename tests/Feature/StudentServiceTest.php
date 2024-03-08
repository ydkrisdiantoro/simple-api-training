<?php

namespace Tests\Feature;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudentServiceTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    // CRUD TEST
    /**
     * Create
     */
    public function test_user_can_create_students()
    {
        $payload = [
            'name' => 'Yayan',
            'birth_date' => date('Y-m-d'),
            'address' => 'Address',
            'year_in' => date('Y'),
            'phone' => '0811111111111',
        ];

        $response = $this->post('/api/student', $payload);
        $response->assertStatus(201);
    }

    /**
     * Read Single Student
     */
    public function test_user_can_read_student()
    {
        $student = Student::first();
        $response = $this->get('/api/student/'.$student->id);
        $response->assertStatus(200);
    }

    /**
     * Read Single Student
     */
    public function test_user_cant_read_student_not_exists()
    {
        $response = $this->get('/api/student/100000');
        $response->assertStatus(404);
    }

    /**
     * Read All Student
     */
    public function test_user_can_read_students()
    {
        $response = $this->get('/api/student');
        $response->assertStatus(200);
    }

    /**
     * Update
     */
    public function test_user_can_update_students()
    {
        $student = Student::first();
        $response = $this->put('/api/student/'.$student->id);
        $response->assertStatus(200);
    }

    /**
     * Delete
     */
    public function test_user_can_delete_students()
    {
        $student = Student::first();
        $response = $this->delete('/api/student/'.$student->id);
        $response->assertStatus(204);
    }
}
