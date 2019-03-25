/**
 * Created by hades on 2018/5/16.
 */
$(document).ready(function () {

    $("#page-content").markdown({
        autofocus: false,
        iconlibrary: 'fa'
    });

    $('body').on('click', '.star-topic', function () {
        var that = $(this);
        $.ajax({
            type: "GET",
            url: "/admin/t/star",
            data: {id: $(this).attr('topicid')},
            dataType: "json",
            success: function (data) {
                if (data.code == 200) {
                    that.removeClass('star-topic label-default');
                    that.addClass('cancel-topic label-warning');
                    that.html('取消');
                }
            }
        })
    });

    $('body').on('click', '.cancel-topic', function () {
        var that = $(this);
        $.ajax({
            type: "GET",
            url: "/admin/t/cancel",
            data: {id: $(this).attr('topicid')},
            dataType: 'json',
            success: function (data) {
                if (data.code == 200) {
                    that.removeClass('cancel-topic label-warning');
                    that.addClass('star-topic label-default');
                    that.html('精选');
                }
            }
        })
    });

    $('.delete-topic').click(function () {
        if (confirm("确定删除该话题？")) {
            var that = $(this);
            $.ajax({
                type: "GET",
                url: "/admin/t/delete",
                data: {id: $(this).attr('topicid')},
                dataType: 'json',
                success: function (data) {
                    if (data.code == 200) {
                        that.parent().parent().parent().remove()
                    }
                }
            })
        }

    });

    $('.delete-reply').click(function () {
        if (confirm("确定删除该回复？")) {
            var that = $(this);
            $.ajax({
                type: "GET",
                url: "/admin/r/delete",
                data: {id: $(this).attr('replyid')},
                dataType: 'json',
                success: function (data) {
                    if (data.code == 200) {
                        that.parent().parent().parent().remove()
                    }
                }
            })
        }

    });

    $('.delete-node').click(function () {
        if (confirm("确定删除该节点？注意：节点下面的话题也会被删除")) {
            var that = $(this);
            $.ajax({
                type: "GET",
                url: "/admin/n/delete",
                data: {id: $(this).attr('nodeid')},
                dataType: 'json',
                success: function (data) {
                    if (data.code == 200) {
                        that.parent().parent().parent().remove()
                    }
                }
            })
        }

    });

    $('.delete-page').click(function () {
        if (confirm("确定删除该文章？")) {
            var that = $(this);
            $.ajax({
                type: "GET",
                url: "/admin/p/delete",
                data: {id: $(this).attr('pageid')},
                dataType: 'json',
                success: function (data) {
                    if (data.code == 200) {
                        that.parent().parent().parent().remove()
                    }
                }
            })
        }

    });

    $('body').on('click', '.add-admin', function () {
        if (confirm("确定将用户设置成管理员？")) {
            var that = $(this);
            $.ajax({
                type: "GET",
                url: "/admin/u/add",
                data: {id: $(this).attr('userid')},
                dataType: 'json',
                success: function (data) {
                    if (data.code == 200) {
                        that.removeClass('add-admin label-warning');
                        that.addClass('delete-admin label-default');
                        that.html('取消管理员');
                    }
                }
            })
        }

    });

    $('body').on('click', '.delete-admin', function () {
        var that = $(this);
        $.ajax({
            type: "GET",
            url: "/admin/u/delete",
            data: {id: $(this).attr('userid')},
            dataType: 'json',
            success: function (data) {
                if (data.code == 200) {
                    that.addClass('add-admin label-warning');
                    that.removeClass('delete-admin label-default');
                    that.html('设为管理员');
                }
            }
        })

    });

});