$('body').on('click', '.sidebar-menu-btn', (event)=>{
	let el = $(event.target).closest('.sidebar-menu');
	let arrow = el.find('.arrow');
	if (el.prop('open') == 'open') {
		arrow.prop('name', 'chevron-forward-outline');
		el.prop('open', 'closed');
	} else {
		arrow.prop('name', 'chevron-down-outline');
		el.prop('open', 'open');
	}
	el.find('.sidebar-submenu').slideToggle();
});

$('body').on('click', '.mobile-menu-btn, .overlay-full', ()=>{
	let sidebar = $('.sidebar');
	let overlay = $('.overlay-full');
	if (sidebar.css('left') == '-250px') {
		overlay.css('display', 'block');
		sidebar.css('left', '0px');
	} else {
		overlay.css('display', 'none');
		sidebar.css('left', '-250px');
	}
});