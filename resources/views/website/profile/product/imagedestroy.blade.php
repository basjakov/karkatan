<div class="images-holder__thumbnail">

    <div class="images-holder__holder">

        <img class="images-holder__image" src="/storage{{$image->image_path}}">

    </div>

    <form method="post" action="{{route('product.destroyimage',$image->id)}}}" >
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <button type="submit" title="" class="btn waves-effect waves-light red tooltips js-ajax-delete"><i class="material-icons center">delete_sweep</i></button>
    </form>

</div>
