<div class="container text-right">
    <a href="{!! url()->current() !!}/edit" class="btn btn-success">Изменить</a>
    <form method="POST" class="form-inline" style="display: inline-block" action=""  onsubmit="if(confirm('Вы уверены, что хотите удалить этот материал?')){this.submit();} return false;">
        <input name="_method" type="hidden" value="DELETE">
        <input name="_token" type="hidden" value="{{ csrf_token() }}">
        <button type="submit" class="btn btn-danger">Удалить</button>
    </form>
</div>