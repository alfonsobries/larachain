<?php

namespace App\Models;

use App\Exceptions\WalletNotFoundException;
use Illuminate\Support\Arr;
use App\Services\Ark\ArkExplorer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'username',
        'balance',
        'total_votes',
        'produced_blocks',
        'rank',
        'voting_for_address',
        'voting_for_username',
        'api',
    ];

    public static function updateOrCreateFromApi($walletAddress, $api)
    {
        $model = self::where('address', $walletAddress)->where('api', $api)->first();

        if ($model) {
            return $model;
        }

        $data = self::buildWalletData($walletAddress,  $api);

        return self::create($data);
    }

    public function refreshFromApi()
    {
        $data = self::buildWalletData($this->address, $this->api);
        return tap($this)->update($data);
    }

    private static function buildWalletData($walletAddress, $api)
    {
        $wallet = self::fetchWallet($walletAddress);
        
        if (!$wallet) {
            throw new WalletNotFoundException();
        }

        $votesResponse = self::fetchWalletVotes($walletAddress);
        $totalVotes = self::extractTotalVotesFromVotesResponse($votesResponse);

        $data = [
            'api' => $api,
            'address' => Arr::get($wallet, 'address'),
            'username' => Arr::get($wallet, 'username'),
            'balance' => Arr::get($wallet, 'balance'),
            'produced_blocks' => Arr::get($wallet, 'attributes.delegate.producedBlocks'),
            'rank' => Arr::get($wallet, 'attributes.delegate.rank'),
            'total_votes' => $totalVotes,
        ];

        if ($totalVotes) {
            $votingFor = self::getVotingFromFromVotesResponse($votesResponse);
            $data['voting_for_address'] = Arr::get($votingFor, 'address');
            $data['voting_for_username'] = Arr::get($votingFor, 'username');
        }

        return $data;
    }

    private static function fetchWallet($walletAddress)
    {
        return ArkExplorer::getWallet($walletAddress)->json('data');
    }

    private static function fetchWalletVotes($walletAddress)
    {
        return ArkExplorer::getWalletVotes($walletAddress, ['limit' => 1]);
    }

    private static function extractTotalVotesFromVotesResponse($votesResponse)
    {
        return $votesResponse->json('meta.totalCount');
    }

    private static function getVotingFromFromVotesResponse($votesResponse)
    {
        $latestVote = $votesResponse->json('data.0');

        return ArkExplorer::getBlock($latestVote['blockId'])->json('data.generator');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
