<?php

namespace Tests\Feature;

use App\Models\Student;
use App\Models\User;
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

    public function acting()
    {
        return User::first();
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

        $response = $this->actingAs($this->acting())->post('/api/student', $payload);
        $response->assertStatus(201);
        $response->assertJson([
            'id' => $response->json()['id'],
            'name' => $response->json()['name'],
            'address' => $response->json()['address'],
            'birth_date' => $response->json()['birth_date'],
            'phone' => $response->json()['phone'],
            'year_in' => $response->json()['year_in'],
        ]);
    }

    /**
     * Read Single Student
     */
    public function test_user_can_read_student()
    {
        $student = Student::factory(1)->create()->first();
        $response = $this->actingAs($this->acting())->get('/api/student/'.$student->id);
        $response->assertStatus(200);
        // $response->assertJson([
        //     'id' => $student->id,
        //     'name' => $student->name,
        //     'address' => $student->address,
        //     'birth_date' => $student->birth_date,
        //     'phone' => $student->phone,
        //     'year_in' => $student->year_in,
        // ]);

        $response->assertJsonStructure([
            'result' => [
                'id',
                'name',
                'address',
                'birth_date',
                'phone',
                'year_in',
            ],
            'message',
        ]);
    }

    /**
     * Read Single Student
     */
    public function test_user_cant_read_student_not_exists()
    {
        $response = $this->actingAs($this->acting())->get('/api/student/10000000');
        $response->assertStatus(404);
    }

    /**
     * Read All Student
     */
    public function test_user_can_read_students()
    {
        $response = $this->actingAs($this->acting())->get('/api/student');
        $response->assertStatus(200);
    }

    /**
     * Update
     */
    public function test_user_can_update_students()
    {
        $student = Student::factory(1)->create()->first();
        $update = [
            'name' => 'Yayan Updated',
            'birth_date' => date('Y-m-d'),
            'address' => 'Address updated',
            'year_in' => date('Y'),
            'phone' => '0811111111111',
        ];
        $response = $this->actingAs($this->acting())->put('/api/student/'.$student->id,$update);
        $response->assertStatus(200);
        // $response->assertJson([
        //     'id' => $student->id,
        //     'name' => $update['name'],
        //     'address' => $update['address'],
        //     'birth_date' => $update['birth_date'],
        //     'phone' => $update['phone'],
        //     'year_in' => $update['year_in'],
        // ]);
    }

    /**
     * Delete
     */
    public function test_user_can_delete_students()
    {
        $student = Student::factory(1)->create()->first();
        $response = $this->actingAs($this->acting())->delete('/api/student/'.$student->id);
        $response->assertStatus(204);
    }
}
