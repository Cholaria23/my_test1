<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProductVideoTranslatedFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_translations', function (Blueprint $table) {
            $table->string('video');
        });

        $products = DB::table('products')->get();

        foreach ($products as $product) {
            if ($product->video) {
                DB::table('product_translations')->where('product_id', $product->id)->where('locale', 'ru')->update([
                    'video' => $product->video
                ]);
            }
        }

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('video');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('video');
        });

        $product_translations = DB::table('product_translations')->where('locale', 'ru')->get();

        foreach ($product_translations as $product_translation) {
            if ($product_translation->video) {
                DB::table('products')->where('id', $product_translation->product_id)->update([
                    'video' => $product_translation->video
                ]);
            }
        }

        Schema::table('product_translations', function (Blueprint $table) {
            $table->dropColumn('video');
        });
    }
}
