<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePasswordResetTokensTable extends Migration
{
    public function up()
    {
        Schema::table('password_reset_tokens', function (Blueprint $table) {
            // token 컬럼을 verification_code로 이름 변경
            $table->renameColumn('token', 'verification_code');
            
            // 만료시간을 저장할 expires_at 컬럼 추가
            $table->timestamp('expires_at')->nullable()->after('verification_code');
        });
    }

    public function down()
    {
        Schema::table('password_reset_tokens', function (Blueprint $table) {
            $table->renameColumn('verification_code', 'token');
            $table->dropColumn('expires_at');
        });
    }
}
