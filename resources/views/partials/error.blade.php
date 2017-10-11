@if(Session::has('error'))
    <?php $error = Session::get('error');?>
    <div class="alert alert-error">
        <button class="close" data-dismiss="alert"></button>
        <h4><i class="icon fa fa-ban"></i>{{ array_get($error->get('title'), 0) }}</h4>
        <p>{!!  array_get($error->get('message'), 0) !!}</p>
    </div>
@endif
