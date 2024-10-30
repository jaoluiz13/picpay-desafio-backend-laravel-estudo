<?php

namespace Tests\Feature;

use Tests\TestCase;

class TransferenceTest extends TestCase
{

    private int $id_payer = 1;
    private int $id_payee = 2;
    private float $value = 0.01;


    /** @test */
    public function make_request_and_create_transfer(): void
    {


        /*$response = $this->postJson(
            '/transfer',
            [
                "value" => $this->value,
                "payer" => $this->id_payer,
                "payee" => $this->id_payee,
            ]
        );

        if ($response->assertStatus(201) == false) {
            $response->assertStatus(400)->assertJson(["message" => "Unauthorized transfer"]);
        }*/
    }
}
