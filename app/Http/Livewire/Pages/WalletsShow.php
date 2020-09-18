<?php

namespace App\Http\Livewire\Pages;

use App\Services\Ark\ArkExplorer;
use Livewire\Component;

class WalletsShow extends Component
{
    const ROWS = [
        'username' => 'Username',
        'forged_blocks' => 'Forged Blocks',
        'rank' => 'Rank',
        'voters' => 'Voters',
        'voting_for' => 'Voting For',
    ];

    protected $wallet;
    public $rows;
    public $totalVotes;
    public $votingFor;

    public function mount()
    {
        $this->wallet = ArkExplorer::getWallet(request()->id)->json('data');

        $votesResponse = ArkExplorer::getWalletVotes(request()->id, ['limit' => 1]);

        $this->totalVotes = $this->extractTotalVotesFromVotesResponse($votesResponse);

        if ($this->totalVotes > 0)  {
            $this->votingFor = $this->getVotingFromFromVotesResponse($votesResponse);
        }

        $this->rows = self::ROWS;
    }

    private function extractTotalVotesFromVotesResponse($votesResponse)
    {
        return $votesResponse->json('meta.totalCount');
    }

    private function getVotingFromFromVotesResponse($votesResponse)
    {
        $latestVote = $votesResponse->json('data.0');
        return ArkExplorer::getBlock($latestVote['blockId'])->json('data.generator');
    }

    public function render()
    {
        return view('livewire.pages.wallets.show', [
            'wallet' => $this->wallet,
        ])->layout('layouts.guest');
    }
}
