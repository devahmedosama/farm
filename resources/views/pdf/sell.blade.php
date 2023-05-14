<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Sell</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

    <style type="text/css">
        body{
            background-color: #fff;
        }
        .bill{
            min-height: 200px;
            background-color: #fff;
            margin: 0 auto;
            font-size: 12px;
        }
        .info_ul{
            padding: 0;
        }
        
        
        .products_table {
            width: calc(100% - 20px);
            border: 1px solid #929eaa;
            border-radius: 15px;
            margin: 10px;
        }
        .products_table th{
            width: calc(100% - 20px);
            border: 1px solid #929eaa;
            border-radius: 15px;
            margin: 10px;
            padding: 5px;
        }
        .body_cell_table tr{

        }
        .body_cell_table td {
            padding-bottom: 7px;
            border-bottom: 1px dashed;
            padding-top: 7px;
        }
        .sign_table{
            width: 100%;
        }
        .sign_table td{
            /* border-bottom: 1px dashed; */
        }
        .signature_table tr>td{
            padding: 10px 30px;
            font-size: 16px;
        }
        .items_table{
            width: 100%;
            border-top: 1px solid;
            font-size: 16px;
            padding-bottom: 25px;
        }
        .items_table th{
            padding: 20px 10px;
            border-bottom: 1px solid;
        }
        .items_table td{
            padding: 0 15px;
            padding-top: 15px;
        }
        .table>thead>tr>th {
            color: #2a2a2a;
            border-bottom: 1px solid #ededed;
            font-weight: 500;
        }
        .table th, .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }
        .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
            border-color: #ededed;
            padding: 15px;
        }
    </style>
</head>
<body>
    <div class="bill"  >
        <table style="width: 100%">
            <tbody>
                <tr>
                    <td style="text-align:center;background: #3f87f5;color: #fff;padding: 10px;font-size: 22px;margin: 0">
                    Alduwaisan FARM
                    </td>
                </tr>
            </tbody>
        </table>
       <!--  -->
        <table class="table" style="width:100%;text-align:{{ $text }}"  dir="{{ $dir }}" >
                    <thead>
						<tr>
							<th style="font-size:10px;font-weight: bold;padding: 15 0;">{{ trans('home.Client') }}</th>
							<th style="font-size:10px;font-weight: bold;padding: 15 0;width:190px;">{{ trans('home.Product') }}</th>
							<th style="font-size:10px;font-weight: bold;padding: 15 0;">{{ trans('home.Quantity') }}</th>
							<th style="font-size:10px;font-weight: bold;padding: 15 0;">{{ trans('home.Unit Weight') }}</th>
							<th style="font-size:10px;font-weight: bold;padding: 15 0;">{{ trans('home.Total Weight') }}</th>
							<th style="font-size:10px;font-weight: bold;padding: 15 0;">{{ trans('home.Support Amount') }}</th>
							<th style="font-size:10px;font-weight: bold;padding: 15 0;">{{ trans('home.Packaging') }}</th> 
							<th style="font-size:10px;font-weight: bold;padding: 15 0;">
                                {{ trans('home.Date') }}
                            </th> 
						</tr>
					</thead>
                    <tbody>
                        <?php
                           $weight  = 0;
                           $support = 0;
                           $amount  = 0;
                           $areas   = [];
                         ?>
                       @foreach($allData as $data)
                            @foreach($data->items as $item)
                                <?php 
                                if ($item->farm) {
                                    if (array_key_exists($item->farm->area_id,$areas)) {
                                        $a_weight    =  $areas[$item->farm->area_id]['weight'] +
                                                             $item->quantity*$item->unit_weight;
                                        $a_quantity =  $areas[$item->farm->area_id]['quantity'] + $item->quantity ;
                                        $a_support  =  $areas[$item->farm->area_id]['support'] + ($item->quantity*$item->unit_weight*
                                                            $item->farm->product_type->product->support_amount);
                                    }else {

                                        $a_weight    =  $item->quantity*$item->unit_weight;
                                        $a_quantity =  $item->quantity;
                                        $a_support  =  ($item->quantity*$item->unit_weight*
                                                          $item->farm->product_type->product->support_amount);
                                    }
                                    $areas[$item->farm->area_id] = [
                                        'name'     => $item->farm->name,
                                        'weight'   => $a_weight ,
                                        'quantity' => $a_quantity,
                                        'support'  => $a_support
                                    ];
                                }
                                    
                                    
                                    
                                ?>
                                @if($item->farm)
                                    <tr>
                                        <td style="font-size:10px;">
                                                {{ ($item->client)?$item->client->name:' ' }} 
                                        </td>
                                        <td style="font-size:10px;max-width:250px">
                                                {{ ($item->farm)?$item->farm->name:'' }}
                                        </td>
                                        <td style="font-size:10px;">
                                                {{ $item->quantity }}
                                        </td>
                                        <td style="font-size:10px;">
                                                {{ $item->unit_weight }}
                                        </td>
                                        <td style="font-size:10px;">
                                                {{ $item->unit_weight*$item->quantity }}
                                        </td>
                                        <td style="font-size:10px;">
                                            {{ ($item->quantity*$item->unit_weight*$item->farm->product_type->product->support_amount) }}
                                        </td>
                                        <td style="font-size:10px;">
                                            {{ ($item->stock)?$item->stock->name:' ' }}
                                        </td>
                                        <td style="font-size:10px;">
                                        {{ $data->date }}
                                        </td>
                                    </tr>
                                @endif
                                
                            @endforeach
                        <?php 
                        $weight +=$data->total_weight;
                        $support +=$data->total_support;
                        ?>
                       @endforeach
                       
                       @if(count($areas))
                        @foreach($areas as $ar)
                            <tr>
                                <td style="font-size:13px;text-align: center;font-size: 14px;color:blue
                                ;font-weight:bold" colspan="10">
                                    {{ $ar['name'] }}
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size:13px;" colspan="3">
                                    {{ trans('home.Total Support Amount') }} : 
                                    {{ $ar['support'] }}
                                </td>
                                <td style="font-size:13px;" colspan="3">
                                    {{ trans('home.Total Weight') }} : {{ $ar['weight'] }}
                                </td>
                                <td style="font-size:13px;" colspan="4">
                                    {{ trans('home.Quantity') }} : {{ $ar['quantity'] }}
                                </td>
                            </tr>
                            <?php
                               $amount += $ar['quantity']; 
                             ?>
                        @endforeach
                        @endif
                        <tr>
                            <td style="font-size:13px;text-align: center;font-size: 14px;color:blue
                                ;font-weight:bold" colspan="10"> 
                               الاجمالي
                            </td>
                            
                        </tr>
                        <tr>
                           
                            <td colspan="3">
                                {{ trans('home.Total Support Amount').' :  '.$support }}
                            </td>
                            <td colspan="4"> 
                                {{ trans('home.Total Weight').' :  '.$weight  }}
                            </td>
                            <td colspan="4"> 
                                {{ trans('home.Amount').' :  '.$amount  }}
                            </td>
                        </tr>
                    </tbody>
                </table>               
    </div>
</body>
</html>