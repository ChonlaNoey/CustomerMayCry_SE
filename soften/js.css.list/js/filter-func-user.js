$(document).ready(function(){

filter_data();

function filter_data()
{
    $('.filter_data').html('<div id="loading" style="" ></div>');
    var action = 'fetch_data';
    var category = get_filter('category');
    var type = get_filter('type');
    var location = get_filter('location');
    var status = get_filter('status');
    $.ajax({
        url:"fetch_data-list-user.php",
        method:"POST",
        data:{action:action, category:category, type:type, location:location, status:status},
        success:function(data){
            $('.filter_data').html(data);
        }
    });
}

function get_filter(class_name)
{
    var filter = [];
    $('.'+class_name+':checked').each(function(){
        filter.push($(this).val());
    });
    return filter;
}

$('.common_selector').click(function(){
    filter_data();
    });
});