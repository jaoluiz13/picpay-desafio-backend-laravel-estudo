<?php

namespace Tests\Feature;

use Tests\TestCase;

class UserTest extends TestCase
{

    private  string $full_name = 'Test user';
    private string $email = 'test@gmail.com';
    private string $doc_number = '00000000000';
    private string $phone = '32999999999';
    private string $password = 'Test@1234';
    private float $initialBalance = 1000;

    public function generateRandomEmailAndDoc()
    {
        $this->email = $this->generateRandomEmail();
        $this->doc_number = $this->generateRandomDocNumber();
    }

    private function generateRandomEmail(): string
    {
        $domains = ['example.com', 'test.com', 'mail.com'];
        $randomName = strtolower(substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 0, 8));
        $randomDomain = $domains[array_rand($domains)];

        return "{$randomName}@{$randomDomain}";
    }

    private function generateRandomDocNumber(): string
    {
        return (string) random_int(10000000000, 99999999999);
    }


    /** @test */
    public function make_request_and_create_new_user(): void
    {

        $this->generateRandomEmailAndDoc();

        $response = $this->postJson(
            '/user/create',
            [
                "full_name" => $this->full_name,
                "email" => $this->email,
                "doc_number" => $this->doc_number,
                "phone_number" => $this->phone,
                "password" => $this->password
            ]
        );

        $response->assertStatus(201)->assertJson([
            "user" => [
                "full_name" => $this->full_name,
                "email" => $this->email,
                "doc_number" => $this->doc_number,
                "phone_number" => $this->phone,
                "password" => $this->password,
                "balance" => $this->initialBalance
            ]
        ]);

        $this->assertDatabaseHas('users', [
            'email' => $this->email,
        ]);
    }

    /** @test */
    public function make_request_and_create_email_existent_user(): void
    {

        $this->doc_number = $this->generateRandomDocNumber();

        $response = $this->postJson(
            '/user/create',
            [
                "full_name" => $this->full_name,
                "email" => $this->email,
                "doc_number" => $this->doc_number,
                "phone_number" => $this->phone,
                "password" => $this->password
            ]
        );

        $response->assertStatus(400)->assertJson(["message" => "User Email Already exists"]);
    }

    /** @test */
    public function make_request_and_create_doc_number_existent_user(): void
    {

        $this->email = $this->generateRandomEmail();

        $response = $this->postJson(
            '/user/create',
            [
                "full_name" => $this->full_name,
                "email" => $this->email,
                "doc_number" => $this->doc_number,
                "phone_number" => $this->phone,
                "password" => $this->password
            ]
        );

        $response->assertStatus(400)->assertJson(["message" => "User Document Already exists"]);
    }
}
