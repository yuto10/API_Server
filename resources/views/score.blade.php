<!-- resources/views/score.blade.php -->
@extends('layouts.app')
@section('content')

    <div class="card-body">
        <div class="card-title">
            ランキングの一覧
        </div>  

    </div>
    @if (count($ranking) > 0)
        <div class="card-body">
            <div class="card-body">
                <table class="table table-striped task-table">
                    
                    <thead>
                        <th>スコア一覧</th>
                        <th>&nbsp;</th>
                    </thead>
                    
                    <tbody>
                        @foreach ($ranking as $score)
                            <tr>
                                
                                <td class="table-text">
                                    <div> ユーザーID : {{ $score->user_id}} / スコア : {{ $score->high_score }}</div>
                                </td>

                                
                                <td>
				    <form action="{{ url('score_del/'.$score->user_id) }}" method="POST">
        				@csrf               
        				@method('DELETE')   
        
        				<button type="submit" class="btn btn-danger">
        				    削除
       				        </button>
     				    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

@endsection			

