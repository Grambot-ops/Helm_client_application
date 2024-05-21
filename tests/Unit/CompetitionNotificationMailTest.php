<?php
use App\Models\Competition;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompetitionNotificationMailTest extends TestCase
{
    use RefreshDatabase;



    /** @test */
    public function a_competition_can_be_created()
    {
        // Arrange
        $competitionData = [
            'title' => 'Science and Tech Quest',
            'competition_type_id' => 1, // Replace with an existing competition type ID
            // Add other required fields as needed
        ];

        // Act
        Competition::create($competitionData);

        // Assert
        $this->assertDatabaseHas('competitions', $competitionData);
    }
}
