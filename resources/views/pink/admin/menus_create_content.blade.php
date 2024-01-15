	<div id="content-page" class="content group">
        <div class="hentry group">
            <h2>Create item menu</h2>
           
            {!! Form::open(['route' => 'menus.store']) !!}

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
        });
    </script>