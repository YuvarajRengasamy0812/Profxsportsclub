<div class="ft_navi_main_wrapper float_left">
	<div class="ft_menu_wrapper">

            <!-- mobile menu area start -->
            <div class="rp_mobail_menu_main_wrapper">
                
            </div>
            <div class="ft_login_wrapper">
               
            </div>
        </div>
	<div class="ft_logo_wrapper">
		<a href="{{ Helper::homeURL() }}">
			@if (Helper::GeneralSiteSettings('style_logo_' . @Helper::currentLanguage()->code) != '')
				<img alt="{{ Helper::GeneralSiteSettings('site_title_' . @Helper::currentLanguage()->code) }}"
					src="{{ URL::to('uploads/settings/' . Helper::GeneralSiteSettings('style_logo_' . @Helper::currentLanguage()->code)) }}"
					style="max-width:115px" />
			@else
				<img alt="{{ Helper::GeneralSiteSettings('site_title_' . @Helper::currentLanguage()->code) }}" src="{{ URL::to('uploads/settings/nologo.png') }}"  />
			@endif
		</a>
	</div>
	<div class="ft_right_wrapper">
		
	</div>
</div>

