<?php

namespace Tests\Feature;

use App\Models\Voucher;
use Database\Seeders\VoucherSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VoucherTest extends TestCase
{
    public function testCreateVoucher()
    {
        $voucher = new Voucher();
        $voucher->name = "Sample Voucher";
        $voucher->voucher_code = "130498712341";
        $voucher->save();

        $this->assertNotNull($voucher->id);
    }

    public function testCreateVoucherUUID()
    {
        $voucher = new Voucher();
        $voucher->name = "Sample Voucher";
        $voucher->save();

        $this->assertNotNull($voucher->id);
    }

    public function testSoftDelete()
    {
        $this->seed(VoucherSeeder::class);

        $voucher = Voucher::where('name', '=', 'Sample Voucher')->first();
        $voucher->delete();

        $voucher = Voucher::where('name', '=', 'Sample Voucher')->first();
        $this->assertNull($voucher);

        $voucher = Voucher::withTrashed()->where('name', '=', 'Sample Voucher')->first();
        $this->assertNotNull($voucher);
    }

    public function testLocalScope()
    {
        $voucher = new Voucher();
        $voucher->name = "Sampel Voucher";
        $voucher->is_active = true;
        $voucher->save();

        $total = Voucher::active()->count();
        $this->assertEquals(1, $total);

        $total = Voucher::nonActive()->count();
        $this->assertEquals(0, $total);
    }
}
