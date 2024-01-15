	<div id="content-page" class="content group">
        <div class="hentry group">
            <h2>Create item menu</h2>
           
            {!! Form::model($menu, ['route' => ['menus.update', $menu->id], 'method' => 'PUT']) !!}

                @include(env('THEME') . '.admin.menus_form_content')
                                
                {!! Form::submit('Add item', ['class' => 'btn btn-large  btn-view-over-the-town-5']) !!}

            {!! Form::close() !!}

        </div>
    </div>

    <script>
        jQuery(function($) {
            $('#accordion').accordion({
                
                activate: function(e, obj) {
                    obj.newPanel.prev().find('input[type=radio]').attr('checked', 'checked');
                }

            });

            var active = 0;
            $('#accordion input[type=radio]').each(function(ind, it) {
                if($(this).prop('checked')) {
                    active = int;
                }
            });

            $('#accordion').accordion('option', 'active', active);

        });
    </script>