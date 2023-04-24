<?php

namespace Tests\Feature;

use App\Models\PassengerOnBoard;
use App\Models\UserGroup;
use App\Models\Operator;
use App\Models\Vessel;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Artisan;

class PassengerOnBoardTest extends TestCase
{
    /**
     * reset your database after each of your tests so that data 
     * from a previous test does not interfere with subsequent tests
     */
    use RefreshDatabase;
    
    /**
     * Prefix for our endpoint
     */
    private $PREFIX = 'api/v1/pob';

    /**
     * Test index end point
     */
    public function test_index_api_return_passengers_on_board_records(): void
    {
        $result = PassengerOnBoard::all();

        $response = $this->getJson($this->PREFIX);
        $response
            ->assertJson($result->toArray())
            ->assertStatus(200);
    }

    
    /**
     * Test a successful call to the store method for our passegners api
     */
    public function test_store_api_success(): void
    {
        $vessel = Vessel::factory()->create([
            'mmsi' => 'MID123456',
            'operator_id' => 1
        ]);

        $record = [
            "submittedBy" => 1,
            "authentication" => "testToken",
            "mmsi" => $vessel->mmsi,
            "passengerNumber" => 10,
            "reportTime" => date('Y-m-d')
        ];

        $response = $this->postJson($this->PREFIX, $record);
        $response
            ->assertExactJson(["Record added successfully."])
            ->assertStatus(201);
    }

    /**
     * Test a failed call to the store method for our passegners api
     */
    public function test_store_api_unnsuccessfull_missing_submittedBy(): void
    {
        $record = [
            // "submittedBy" => 1,
            "authentication" => "testToken",
            "mmsi" => 'testMMSI',
            "passengerNumber" => 10,
            "reportTime" => date('Y-m-d')
        ];

        $response = $this->postJson($this->PREFIX, $record);
        $response->assertStatus(422);
    }

    /**
     * Test a failed call to the store method for our passegners api
     */
    public function test_store_api_unnsuccessfull_missing_authentication(): void
    {
        $record = [
            "submittedBy" => 1,
            // "authentication" => "testToken",
            "mmsi" => 'testMMSI',
            "passengerNumber" => 10,
            "reportTime" => date('Y-m-d')
        ];

        $response = $this->postJson($this->PREFIX, $record);
        $response->assertStatus(422);
    }

    /**
     * Test a failed call to the store method for our passegners api
     */
    public function test_store_api_unnsuccessfull_missing_mmsi(): void
    {
        $record = [
            "submittedBy" => 1,
            "authentication" => "testToken",
            // "mmsi" => 'testMMSI',
            "passengerNumber" => 10,
            "reportTime" => date('Y-m-d')
        ];

        $response = $this->postJson($this->PREFIX, $record);
        $response->assertStatus(422);
    }

    /**
     * Test a failed call to the store method for our passegners api
     */
    public function test_store_api_unnsuccessfull_missing_passengerNumber(): void
    {
        $record = [
            "submittedBy" => 1,
            "authentication" => "testToken",
            "mmsi" => 'testMMSI',
            // "passengerNumber" => 10,
            "reportTime" => date('Y-m-d')
        ];

        $response = $this->postJson($this->PREFIX, $record);
        $response->assertStatus(422);
    }

    /**
     * Test a failed call to the store method for our passegners api
     */
    public function test_store_api_unnsuccessfull_missing_reportedTime(): void
    {
        $record = [
            "submittedBy" => 1,
            "authentication" => "testToken",
            "mmsi" => 'testMMSI',
            "passengerNumber" => 10,
            // "reportTime" => date('Y-m-d')
        ];

        $response = $this->postJson($this->PREFIX, $record);
        $response->assertStatus(422);
    }

    /**
     * Test a failed call to the store method for our passegners api
     * TODO: Add when the person who submits is invalid
     */
    public function test_store_api_unnsuccessfull_invalid_submittedBy(): void
    {
        $record = [
            "submittedBy" => 1,
            "authentication" => "testToken",
            "mmsi" => 'testMMSI',
            "passengerNumber" => 10,
            "reportTime" => date('Y-m-d')
        ];

        $response = $this->postJson($this->PREFIX, $record);
        $response->assertStatus(422);
    }

    /**
     * Test a failed call to the store method for our passegners api
     * TODO: Add when the authenitcating token is invalid
     */
    public function test_store_api_unnsuccessfull_invalid_authentication(): void
    {
        $record = [
            "submittedBy" => 1,
            "authentication" => "testToken",
            "mmsi" => 'testMMSI',
            "passengerNumber" => 10,
            "reportTime" => date('Y-m-d')
        ];

        $response = $this->postJson($this->PREFIX, $record);
        $response->assertStatus(422);
    }

    /**
     * Test a failed call to the store method for our passegners api
     */
    public function test_store_api_unnsuccessfull_invalid_mmsi(): void
    {
        $record = [
            "submittedBy" => 1,
            "authentication" => "testToken",
            "mmsi" => 'wrong mmsi',
            "passengerNumber" => 10,
            "reportTime" => date('Y-m-d')
        ];

        $response = $this->postJson($this->PREFIX, $record);
        $response->assertStatus(422);
    }

    /**
     * Test a failed call to the store method for our passegners api
     */
    public function test_store_api_unnsuccessfull_invalid_date_not_today(): void
    {
        $record = [
            "submittedBy" => 1,
            "authentication" => "testToken",
            "mmsi" => 'wrong mmsi',
            "passengerNumber" => 10,
            "reportTime" => '1994/10/07' //Y-m-d
        ];

        $response = $this->postJson($this->PREFIX, $record);
        $response->assertStatus(422);
    }
}
