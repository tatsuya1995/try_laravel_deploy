@extends('layouts.common')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">【管理者用】契約済情報</div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-responsive text-center">
                            <tr>
                                <th>No.</th>
                                <th>オーナー名</th>
                                <th>ドライバー名</th>
                                <th>貸出日</th>
                                <th>時間</th>
                                <th>返却日</th>
                                <th>時間</th>
                                <th>車両名</th>
                                <th>最大乗車人数</th>
                                <th>ナンバープレート</th>
                                <th>合計金額</th>
                            </tr>
                            @foreach($contracts as $contract)
                            <tr>
                                <td>{{$contract->id}}</td>
                                <td>{{$contract->nameOwner}}</td> 
                                <td>{{$contract->nameDriver}}</td> 
                                <td><?php echo(date('Y/m/d', strtotime($contract->dateDeparture))) ?></td> 
                                <td><?php echo(date('H:i', strtotime($contract->timeDeparture))) ?></td>
                                <td><?php echo(date('Y/m/d', strtotime($contract->dateRevert))) ?></td>
                                <td><?php echo(date('H:i', strtotime($contract->timeRevert))) ?></td>
                                <td>{{$contract->nameCar}}</td>
                                <td>{{$contract->numPeople}}</td>
                                <td>{{$contract->carNumber}}</td>
                                <td>{{$contract->subTotal}}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
