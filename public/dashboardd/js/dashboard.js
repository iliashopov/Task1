
$('document').ready(function () {
    document.addEventListener('mousedown', onMouseDown)
    document.addEventListener('change', onChange)
});
var currentCell = false
function onMouseDown(e)
{
    if (e.target.attributes.md)
    {
        window[e.target.attributes.md.value](e);
    }
}
function onChange(e)
{
    if (currentCell !== false)
    {
        let colors = $('#color_edit').find(":selected").attr('class');
        colors = colors.split(" ");
        let divClass = 'col-sm mm ' + colors[0]
        //  let linkClass = 'text-mm ' + colors[1]


        let linkClass = 'fa fa-plus-circle fa-2x ' + colors[1];
        let t = $(currentCell).find('a').attr('class')
        let t1 = t.search('fa fa-plus-circle fa-2x')
        if (t1 == -1)
        {
            linkClass = 'text-mm ' + colors[1]
        }
        $(currentCell).attr('class', divClass)
        $(currentCell).find('a').attr('class', linkClass);
        $(currentCell).attr('color', colors[0])
        $(currentCell).find('a').attr('color', colors[1]);

        $("#color_edit").attr('class', 'form-control ' + colors[0] + ' ' + colors[1]);
        var nit = 0;
    }
}
function editLink(e)
{
    currentCell = e.target;
    let text = $(e.target).find('a').text();
    let link = $(e.target).find('a').attr('href');
    let fontcolor = $(e.target).find('a').attr('color');
    let bgcolor = $(e.target).attr('color');

    $('#edit_container').fadeIn();
    $('#but_remove').fadeIn();
    $('#but_ok').fadeIn();

    $('#url_edit').val(link);
    $('#text_edit').val(text);

    $("#color_edit").val(bgcolor).change();
    $("#color_edit").attr('class', 'form-control ' + bgcolor + ' ' + fontcolor);

}
function hide_edit(e)
{
    $('#edit_container').fadeOut();
}
function send_ok(e)
{
    let a = $(currentCell).find('a')
    let data = {};
    data.id = $(currentCell).attr('tid');
    data.color_bg = $(currentCell).attr('color');
    data.color_text = $(a).attr('color');
    //  data.class = $(currentCell).find('a').attr('class');
    data.class = 'text-mm ';
    data.user_id = $(currentCell).attr('user');
    data.target = '_blank';
    data.url_link = $('#url_edit').val();
    data.text = $('#text_edit').val();
    ajax('save', data, 'updateCell', true)
}
function updateCell(rs)
{
    if (rs == 'ok')
    {
        let a = $(currentCell).find('a')
        var nit = $(a).attr('color');

        $(a).attr('href', $('#url_edit').val());
        $(a).attr('target', '_blank');
        $(a).attr('class', 'text-mm ' + $(a).attr('color'));
        $(a).text($('#text_edit').val());

        $('#but_remove').fadeOut();
        $('#but_ok').fadeOut();
        $('#url_edit').val('');
        $('#text_edit').val('');
        currentCell = false
    }
    else
        alert(rs);

}
function send_new(e)
{
    let children = $('[md="editLink"]').first().attr('user');
    ajax('add', {user_id:children}, 'addNewCell', true)
    var nit=0;
}
function addNewCell(rs)
{
    let data=JSON.parse(rs);
    let children = $('[md="editLink"]');
    let x=children.length%3;
    var nit=0;
    let html='';
    if(x===0)
    {
        html+='<div class="w-100"></div>'
    }
    html+='<div id="item_'+data.id+'" md="editLink" tid="'+data.id+'" color="bg-secondary" user="'+data.user_id+'" class="col-sm mm bg-secondary"> '             
                html+='<a href="#" color="text-white" target="_self" class="fa fa-plus-circle fa-2x text-white"></a> '

            html+='</div> <div class="w5mm"></div>'
    $('#rows_mm').append(html);        
}
function send_remove(e)
{
    let children = $('[md="editLink"]');
    if (children.length > 1)
    {
        let a = $(currentCell).find('a')
        let data = {};
        data.id = $(currentCell).attr('tid');
        data.user_id = $(currentCell).attr('user');
        ajax('remove', data, false, false)

        $(currentCell).remove()
        $('#but_remove').fadeOut();
        $('#but_ok').fadeOut();
        $('#url_edit').val('');
        $('#text_edit').val('');
    }
    else
    {
        $('#but_remove').fadeOut();
        $('#but_ok').fadeOut();
        $('#url_edit').val('');
        $('#text_edit').val('');
    }
    currentCell = false
}
function ajax(options, data, callBack, callBackParams)
{
    $.ajax({
        url: '/dashboard-ajax',
        type: 'POST',
        data: {options: options, data: JSON.stringify(data)},
        dataType: 'html',
        callBack: callBack,
        callBackParams: callBackParams,
        success: function (rs)
        {
            if (this.callBackParams === false)
            {
                if (this.callBack !== false)
                {
                    window[this.callBack]();
                }
            }
            else
            {
                if (this.callBack !== false)
                {
                    window[this.callBack](rs);
                }
            }
        }
    });
}

