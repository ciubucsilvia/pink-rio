<div id="content-page" class="content group">
	<div class="hentry group">
		<h2>Menus</h2>

		    <div class="short-table white">
            	
            	{!! Html::link(route('menus.create'), 'Item add', ['class' => 'btn btn-identification-4']) !!}

                <table style="width: 100%" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Link</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    	@if($menu)
                    		@include(env('THEME') . '.admin.custom-menu-items', ['items' => $menu->roots(), 'paddingLeft' => ''])
                    	@endif
                    </tbody>
                </table>
            </div>

	</div>
</div>