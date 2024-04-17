<?php

namespace App\Exports;

use App\Models\SalesDetail;
use App\Models\Sale;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\FromCollection;

class DetailExport implements FromCollection, WithHeadings, WithMapping, WithColumnFormatting
{
    public function collection()
    {
        return SalesDetail::selectRaw('sales.id, customers.customer_name as customer_name, customers.address as customer_address, customers.phone_number as customer_phone, sales.date, sales.price_total, users.name as user_name, products.product_name as product_name, products.price as product_price, sales_details.quantity, sales_details.quantity * products.price as subtotal')
            ->join('sales', 'sales_details.sale_id', '=', 'sales.id')
            ->join('customers', 'sales.customer_id', '=', 'customers.id')
            ->join('users', 'sales.user_id', '=', 'users.id')
            ->join('products', 'sales_details.product_id', '=', 'products.id')
            ->get();
    }

    private $index = 0;

    public function map($sale): array
    {
        return [
            ++$this->index,
            $sale->customer_name,
            $sale->customer_address,
            $sale->customer_phone,
            $sale->product_name,
            'Rp ' . number_format($sale->product_price, 2, '.', ','),
            'Rp ' . number_format($sale->subtotal, 2, '.', ','),
            $sale->sale_date,
            $sale->user_name,
        ];
    }

    public function headings(): array
    {
        return [
            'No',
            'Customer Name',
            'Customer Address',
            'Customer Phone',
            'Product Name',
            'Product Price',
            'Subtotal',
            'Sale Date',
            'Created By',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'E' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'G' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
        ];
    }
}