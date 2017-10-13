@if($errors->hasBag('exception'))
    <?php $error = $errors->getBag('exception');?>
    <div class="alert">
          <button class="close" data-dismiss="alert"></button>
          <h4>
              <i class="icon fa fa-warning"></i>
              <i style="cursor: pointer;" title="{{ $error->get('type')[0] }}" ondblclick="var f=this.innerHTML;this.innerHTML=this.title;this.title=f;">{{ class_basename($error->get('type')[0]) }}</i>
              In <i title="{{ $error->get('file')[0] }} line {{ $error->get('line')[0] }}" style="border-bottom: 1px dotted #fff;cursor: pointer;" ondblclick="var f=this.innerHTML;this.innerHTML=this.title;this.title=f;">{{ basename($error->get('file')[0]) }} line {{ $error->get('line')[0] }}</i> :
          </h4>
          <p>{!! $error->get('message')[0] !!}</p>
    </div>
@endif
