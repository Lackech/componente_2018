var K2JVersion;
var selectsInstance;
$K2(document).ready(function() {

    selectsInstance = jQuery;


    // Common functions
    $K2('#jToggler').click(function() {
        if ($K2(this).attr('checked')) {
            $K2('input[id^=cb]').attr('checked', true);
            $K2('input[name=boxchecked]').val($K2('input[id^=cb]:checked').length);
        } else {
            $K2('input[id^=cb]').attr('checked', false);
            $K2('input[name=boxchecked]').val('0');
        }
    });
    $K2('#k2SubmitButton').click(function() {
        this.form.submit();
    });
    $K2('#k2ResetButton').click(function(event) {
        event.preventDefault();
        $K2('.k2AdminTableFilters input').val('');
        $K2('.k2AdminTableFilters option').removeAttr('selected');
        this.form.submit();
    });
    selectsInstance('.k2AdminTableFilters select').change(function() {
        this.form.submit();
    });

    // View specific functions
    if ($K2('#k2AdminContainer').length > 0) {
        var view = $K2('#k2AdminContainer input[name=view]').val();
    } else {
        var view = $K2('#k2FrontendContainer input[name=view]').val();
    }

    $K2('.k2ReportUserButton').click(function(event) {
        event.preventDefault();
        if (view == 'comments') {
            var alert = K2Language[2];
        } else {
            var alert = K2Language[0];
        }
        if (confirm(alert)) {
            window.location.href = $K2(this).attr('href');
        }
    });

    switch(view) {



        case 'item':
            $K2('#k2Accordion').accordion({
                collapsible : true,
                autoHeight : false
            });
            $K2('#k2Tabs').tabs();
            if ( typeof (K2ActiveVideoTab) === 'undefined') {
                $K2('#k2VideoTabs').tabs();
            } else {
                $K2('#k2VideoTabs').tabs({
                    selected : K2ActiveVideoTab
                });
            }
            $K2('#k2ToggleSidebar').click(function(event) {
                event.preventDefault();
                $K2('#adminFormK2Sidebar').toggle();
            });
            $K2('#catid option[disabled]').css('color', '#808080');



            $K2('#newTagButton').click(function() {
                var log = $K2('#tagsLog');
                log.empty().addClass('tagsLoading');
                var tag = $K2('#tag').val();
                var url = 'index.php?option=com_k2&view=item&task=tag&tag=' + tag;
                $K2.ajax({
                    url : url,
                    type : 'get',
                    dataType : 'json',
                    success : function(response) {
                        if (response.status == 'success') {
                            var option = $K2('<option/>', {
                                value : response.id
                            }).html(response.name).appendTo($K2('#tags'));
                        }
                        log.html(response.msg);
                        log.removeClass('tagsLoading');
                    }
                });
            });
            $K2('#addTagButton').click(function() {
                $K2('#tags option:selected').each(function() {
                    $K2(this).appendTo($K2('#selectedTags'));
                });
            });
            $K2('#removeTagButton').click(function() {
                $K2('#selectedTags option:selected').each(function(el) {
                    $K2(this).appendTo($K2('#tags'));
                });
            });
            selectsInstance('#catid').change(function() {
                if (selectsInstance.find('option:selected').attr('disabled')) {
                    alert(K2Language[4]);
                    selectsInstance(this).val('0');
                    return;
                }
                var selectedValue = $K2(this).val();
                var url = K2BasePath + 'index.php?option=com_k2&view=item&task=extraFields&cid=' + selectedValue + '&id=' + $K2('input[name=id]').val();
                $K2('#extraFieldsContainer').fadeOut('slow', function() {
                    $K2.ajax({
                        url : url,
                        type : 'get',
                        success : function(response) {
                            $K2('#extraFieldsContainer').html(response);
                            $K2('img.calendar').each(function() {
                                inputFieldID = $K2(this).prev().attr('id');
                                imgFieldID = $K2(this).attr('id');
                                Calendar.setup({
                                    inputField : inputFieldID,
                                    ifFormat : "%Y-%m-%d",
                                    button : imgFieldID,
                                    align : "Tl",
                                    singleClick : true
                                });
                            });
                            $K2('#extraFieldsContainer').fadeIn('slow');
                        }
                    });
                });
            });

            $K2('.tagRemove').click(function(event) {
                event.preventDefault();
                $K2(this).parent().remove();
            });
            $K2('ul.tags').click(function() {
                $K2('#search-field').focus();
            });
            $K2('#search-field').keypress(function(event) {
                if (event.which == '13') {
                    if ($K2(this).val() != '') {
                        $K2('<li class="addedTag">' + $K2(this).val() + '<span class="tagRemove" onclick="$K2(this).parent().remove();">x</span><input type="hidden" value="' + $K2(this).val() + '" name="tags[]"></li>').insertBefore('.tags .tagAdd');
                        $K2(this).val('');
                    }
                }
            });
            $K2('#search-field').autocomplete({
                source : function(request, response) {
                    $K2.ajax({
                        type : 'post',
                        url : K2SitePath + 'index.php?option=com_k2&view=item&task=tags',
                        data : 'q=' + request.term,
                        dataType : 'json',
                        success : function(data) {
                            $K2('#search-field').removeClass('tagsLoading');
                            response($K2.map(data, function(item) {
                                return item;
                            }));
                        }
                    });
                },
                minLength : 3,
                select : function(event, ui) {
                    $K2('<li class="addedTag">' + ui.item.label + '<span class="tagRemove" onclick="$K2(this).parent().remove();">x</span><input type="hidden" value="' + ui.item.value + '" name="tags[]"></li>').insertBefore('.tags .tagAdd');
                    this.value = '';
                    return false;
                },
                search : function(event, ui) {
                    $K2('#search-field').addClass('tagsLoading');
                }
            });

            break;
    }
});


