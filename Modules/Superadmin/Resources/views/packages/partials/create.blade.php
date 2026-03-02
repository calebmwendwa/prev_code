<div class="modal-dialog" role="document">
    <div class="modal-content">
        {!! Form::open(['url' => action([\Modules\Superadmin\Http\Controllers\PackagesCategoryController::class, 'store']),
                           'method' => 'post',
                           'id' => 'package_category_add_form',
                       ]) !!}
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">@lang( 'Add Package Category' )</h4>
</div>

<div class="modal-body">
    <div class="form-group">
        {!! Form::label('name', __( 'lang_v1.name' ) . ':*') !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => __( 'lang_v1.name' ) ]); !!}
    </div>

    <div class="form-group">
        {!! Form::label('description', __( 'brand.short_description' ) . ':') !!}
        {!! Form::text('description', null, ['class' => 'form-control','placeholder' => __( 'brand.short_description' )]); !!}
    </div>

    <div class="form-group">
        {!! Form::label('priority', __( 'lang_v1.priority' ) . ':') !!}
        {!! Form::text('priority', null, ['class' => 'form-control','placeholder' => __( 'lang_v1.priority' )]); !!}
    </div>
</div>


        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">@lang( 'messages.save' )</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
        </div>

{!! Form::close() !!}
    </div><!-- /.modal-content -->
</div><!-- /.modal-di

