<?php

namespace Tests\Feature;

use App\Models\Photo;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PhotoListApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function should_正しい構造のJSONを返却する()
    {
        // 5つの写真データを生成する
        Photo::factory(5)->create();

        $response = $this->json('GET', route('photo.index'));

        // 生成した写真データを作成日降順で取得
        $photos = Photo::with(['owner'])->orderBy('created_at', 'desc')->get();

        // data項目の期待値
        $expected_data = $photos->map(function ($photo) {
            return [
                'id' => $photo->id,
                'url' => $photo->url,
                'owner' => [
                    'name' => $photo->owner->name,
                ],
            ];
        })
            ->all();

        //Log::debug('デバッグ $expected_data[\'url\']:'.$expected_data[0]['url']);

        //$response->assertStatus(200)
        // レスポンスJSONのdata項目に含まれる要素が5つであること
        $response->assertJsonCount(5);
        // レスポンスJSONのdata項目が期待値と合致すること
        //$response->assertJsonFragment(['data'=>$expected_data]);
    }
}
