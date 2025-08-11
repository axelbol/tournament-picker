<?php

namespace App\Livewire;

use Livewire\Component;

class Sudamericana extends Component
{
    public $teams = [];
    public $rounds = [];
    public $currentRound = 'round16';
    public $winner = null;

    public function mount()
    {
        $this->initializeBracket();
    }

    public function initializeBracket()
    {
        // Initialize teams for Round of 16
        $this->teams = [
            // Round of 16 teams (8 matches)
            ['id' => 1, 'name' => 'UCH', 'code' => 'UCH', 'logo' => 'img/logos/sud/udechile.png', 'eliminated' => false],
            ['id' => 2, 'name' => 'IND', 'code' => 'IND', 'logo' => 'img/logos/sud/independiente.png', 'eliminated' => false],
            ['id' => 3, 'name' => 'ALI', 'code' => 'ALI', 'logo' => 'img/logos/sud/alianzalima.png', 'eliminated' => false],
            ['id' => 4, 'name' => 'UNI', 'code' => 'UNI', 'logo' => 'img/logos/sud/universidadcatolica.png', 'eliminated' => false],
            ['id' => 5, 'name' => 'CEC', 'code' => 'CEC', 'logo' => 'img/logos/sud/centralcordoba.png', 'eliminated' => false],
            ['id' => 6, 'name' => 'LAN', 'code' => 'LAN', 'logo' => 'img/logos/sud/lanus.png', 'eliminated' => false],
            ['id' => 7, 'name' => 'AMC', 'code' => 'AMC', 'logo' => 'img/logos/sud/america.png', 'eliminated' => false],
            ['id' => 8, 'name' => 'FLU', 'code' => 'FLU', 'logo' => 'img/logos/sud/fluminense.png', 'eliminated' => false],
            ['id' => 9, 'name' => 'CAM', 'code' => 'CAM', 'logo' => 'img/logos/sud/atlmineiro.png', 'eliminated' => false],
            ['id' => 10, 'name' => 'GCM', 'code' => 'GCM', 'logo' => 'img/logos/sud/godoycruz.png', 'eliminated' => false],
            ['id' => 11, 'name' => 'BOL', 'code' => 'BOL', 'logo' => 'img/logos/sud/bolivar.png', 'eliminated' => false],
            ['id' => 12, 'name' => 'CIE', 'code' => 'CIE', 'logo' => 'img/logos/sud/cienciano.png', 'eliminated' => false],
            ['id' => 13, 'name' => 'INV', 'code' => 'INV', 'logo' => 'img/logos/sud/independientedv.png', 'eliminated' => false],
            ['id' => 14, 'name' => 'MUR', 'code' => 'MUR', 'logo' => 'img/logos/sud/mushucruna.png', 'eliminated' => false],
            ['id' => 15, 'name' => 'OCA', 'code' => 'OCA', 'logo' => 'img/logos/sud/oncecaldas.png', 'eliminated' => false],
            ['id' => 16, 'name' => 'HUR', 'code' => 'HUR', 'logo' => 'img/logos/sud/huracan.png', 'eliminated' => false],
        ];

        $this->rounds = [
            'round16' => [
                ['team1' => 1, 'team2' => 2, 'winner' => null, 'match_id' => 1],
                ['team1' => 3, 'team2' => 4, 'winner' => null, 'match_id' => 2],
                ['team1' => 5, 'team2' => 6, 'winner' => null, 'match_id' => 3],
                ['team1' => 7, 'team2' => 8, 'winner' => null, 'match_id' => 4],
                ['team1' => 9, 'team2' => 10, 'winner' => null, 'match_id' => 5],
                ['team1' => 11, 'team2' => 12, 'winner' => null, 'match_id' => 6],
                ['team1' => 13, 'team2' => 14, 'winner' => null, 'match_id' => 7],
                ['team1' => 15, 'team2' => 16, 'winner' => null, 'match_id' => 8],
            ],
            'quarter' => [
                ['team1' => null, 'team2' => null, 'winner' => null, 'match_id' => 9],
                ['team1' => null, 'team2' => null, 'winner' => null, 'match_id' => 10],
                ['team1' => null, 'team2' => null, 'winner' => null, 'match_id' => 11],
                ['team1' => null, 'team2' => null, 'winner' => null, 'match_id' => 12],
            ],
            'semi' => [
                ['team1' => null, 'team2' => null, 'winner' => null, 'match_id' => 13],
                ['team1' => null, 'team2' => null, 'winner' => null, 'match_id' => 14],
            ],
            'final' => [
                ['team1' => null, 'team2' => null, 'winner' => null, 'match_id' => 15],
            ]
        ];
    }

    public function selectWinner($matchId, $teamId, $round)
    {
        // Find the match and set winner
        foreach ($this->rounds[$round] as $key => $match) {
            if ($match['match_id'] == $matchId) {
                $this->rounds[$round][$key]['winner'] = $teamId;

                // Eliminate the losing team
                $losingTeamId = ($match['team1'] == $teamId) ? $match['team2'] : $match['team1'];
                $this->eliminateTeam($losingTeamId);

                // Advance winner to next round
                $this->advanceWinner($teamId, $round, $key);
                break;
            }
        }
    }

    public function eliminateTeam($teamId)
    {
        foreach ($this->teams as $key => $team) {
            if ($team['id'] == $teamId) {
                $this->teams[$key]['eliminated'] = true;
                break;
            }
        }
    }

    public function advanceWinner($teamId, $currentRound, $matchIndex)
    {
        switch ($currentRound) {
            case 'round16':
                $nextMatchIndex = intval($matchIndex / 2);
                $position = ($matchIndex % 2 == 0) ? 'team1' : 'team2';
                $this->rounds['quarter'][$nextMatchIndex][$position] = $teamId;
                break;

            case 'quarter':
                $nextMatchIndex = intval($matchIndex / 2);
                $position = ($matchIndex % 2 == 0) ? 'team1' : 'team2';
                $this->rounds['semi'][$nextMatchIndex][$position] = $teamId;
                break;

            case 'semi':
                $position = ($matchIndex == 0) ? 'team1' : 'team2';
                $this->rounds['final'][0][$position] = $teamId;
                break;

            case 'final':
                $this->winner = $teamId;
                break;
        }
    }

    // Add to your component to reduce re-renders
    protected $updatesQueryString = [];

    // Cache team lookups
    private $teamCache = [];

    public function getTeamById($teamId)
    {
        if (!isset($this->teamCache[$teamId])) {
            $this->teamCache[$teamId] = collect($this->teams)->firstWhere('id', $teamId);
        }
        return $this->teamCache[$teamId];
    }

    public function resetBracket()
    {
        $this->winner = null;
        $this->initializeBracket();
    }

    public function render()
    {
        return view('livewire.sudamericana');
    }
}
