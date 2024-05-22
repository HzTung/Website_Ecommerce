<div class="comment container ">
    @if ($valueCmt != '')
    @foreach ($valueCmt as $k => $v)
        <div class="showCmtUser" style="box-shadow: 0 1px 2px #2f9d77; padding: 10px; margin: 0 auto; margin-top: 5px; border-radius: 5px; width: 95%;">
            <label for="" style="display: block; text-align: start; font-weight: 600; color: #2f9d77;">{{$v['user_name']}}</label>
            <input type="text" value="{{$v['content']}}" style="width: 95%; font-size: 17px; background-color: #cbcbcb; border: 1px solid transparent; padding: 10px; border-radius: 5px; color: black;" disabled>
            </div>
            
    @endforeach

        @if (Auth::check())
        <br>
        <br>
            <form class="formCmt"  action="{{route('addCmt')}}" method="post">
                @csrf
                <textarea name="content" id="" rows="3" style="width: 100%;" placeholder="Comment..." required></textarea>
                <input type="hidden" name="user_name" id="" value="{{Auth::user()->fullname}}">
                <input type="hidden" name="name_pro" id="" value="{{$product->name_sp}}">
                <input type="hidden" name="time" id="" value="{{now()}}">
                <button  name="submitCmt" value="submit" type="submit" style="display: inline; padding: 0 1rem"><i class="ti-comment"></i></button>            
            </form>
        @endif
    @endif

</div>