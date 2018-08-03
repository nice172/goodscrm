/*!
 * bootstrap-fileinput v4.3.5
 * http://plugins.krajee.com/file-input
 *
 * Author: Kartik Visweswaran
 * Copyright: 2014 - 2016, Kartik Visweswaran, Krajee.com
 *
 * Licensed under the BSD 3-Clause
 * https://github.com/kartik-v/bootstrap-fileinput/blob/master/LICENSE.md
 */
! function(a) {
    "use strict";
    "function" == typeof define && define.amd ? define(["jquery"], a) : "object" == typeof module && module.exports ? module.exports = a(require("jquery")) : a(window.jQuery)
}(function(a) {
    "use strict";
    a.fn.fileinputLocales = {}, a.fn.fileinputThemes = {};
    var b, c, d, e, f, g, h, i, j, k, l, m, n, o, p, q, r, s, t, u, v, w, x, y, z, A, B, C, D, E, F, G, H, I, J, K, L, M, N, O, P, Q, R, S, T, U, V, W, X, Y, Z, $, _, aa, ba, ca, da, ea, fa, ga, ha, ia, ja, ka, la, ma, na, oa;
    b = ".fileinput", c = "kvFileinputModal", d = 'style="width:{width};height:{height};"', e = '<param name="controller" value="true" />\n<param name="allowFullScreen" value="true" />\n<param name="allowScriptAccess" value="always" />\n<param name="autoPlay" value="false" />\n<param name="autoStart" value="false" />\n<param name="quality" value="high" />\n', f = '<div class="file-preview-other">\n<span class="{previewFileIconClass}">{previewFileIcon}</span>\n</div>', g = window.URL || window.webkitURL, h = function(a, b, c) {
        return void 0 !== a && (c ? a === b : a.match(b))
    }, i = function(a) {
        if ("Microsoft Internet Explorer" !== navigator.appName) return !1;
        if (10 === a) return new RegExp("msie\\s" + a, "i").test(navigator.userAgent);
        var c, b = document.createElement("div");
        return b.innerHTML = "<!--[if IE " + a + "]> <i></i> <![endif]-->", c = b.getElementsByTagName("i").length, document.body.appendChild(b), b.parentNode.removeChild(b), c
    }, j = function(a, c, d, e) {
        var f = e ? c : c.split(" ").join(b + " ") + b;
        a.off(f).on(f, d)
    }, k = {
        data: {},
        init: function(a) {
            var b = a.initialPreview,
                c = a.id;
            b.length > 0 && !ea(b) && (b = b.split(a.initialPreviewDelimiter)), k.data[c] = {
                content: b,
                config: a.initialPreviewConfig,
                tags: a.initialPreviewThumbTags,
                delimiter: a.initialPreviewDelimiter,
                previewFileType: a.initialPreviewFileType,
                previewAsData: a.initialPreviewAsData,
                template: a.previewGenericTemplate,
                showZoom: a.fileActionSettings.showZoom,
                showDrag: a.fileActionSettings.showDrag,
                getSize: function(b) {
                    return a._getSize(b)
                },
                parseTemplate: function(b, c, d, e, f, g, h) {
                    var i = " file-preview-initial";
                    return a._generatePreviewTemplate(b, c, d, e, f, !1, null, i, g, h)
                },
                msg: function(b) {
                    return a._getMsgSelected(b)
                },
                initId: a.previewInitId,
                footer: a._getLayoutTemplate("footer").replace(/\{progress}/g, a._renderThumbProgress()),
                isDelete: a.initialPreviewShowDelete,
                caption: a.initialCaption,
                actions: function(b, c, d, e, f, g, h) {
                    return a._renderFileActions(b, c, d, e, f, g, h, !0)
                }
            }
        },
        fetch: function(a) {
            return k.data[a].content.filter(function(a) {
                return null !== a
            })
        },
        count: function(a, b) {
            return k.data[a] && k.data[a].content ? b ? k.data[a].content.length : k.fetch(a).length : 0
        },
        get: function(b, c, d) {
            var j, l, n, o, p, q, e = "init_" + c,
                f = k.data[b],
                g = f.config[c],
                h = f.content[c],
                i = f.initId + "-" + e,
                m = " file-preview-initial",
                r = fa("previewAsData", g, f.previewAsData);
            return d = void 0 === d || d, h ? (g && g.frameClass && (m += " " + g.frameClass), r ? (n = f.previewAsData ? fa("type", g, f.previewFileType || "generic") : "generic", o = fa("caption", g), p = k.footer(b, c, d, g && g.size || null), q = fa("filetype", g, n), j = f.parseTemplate(n, h, o, q, i, p, e, null)) : j = f.template.replace(/\{previewId}/g, i).replace(/\{frameClass}/g, m).replace(/\{fileindex}/g, e).replace(/\{content}/g, f.content[c]).replace(/\{template}/g, fa("type", g, f.previewFileType)).replace(/\{footer}/g, k.footer(b, c, d, g && g.size || null)), f.tags.length && f.tags[c] && (j = ia(j, f.tags[c])), da(g) || da(g.frameAttr) || (l = a(document.createElement("div")).html(j), l.find(".file-preview-initial").attr(g.frameAttr), j = l.html(), l.remove()), j) : ""
        },
        add: function(b, c, d, e, f) {
            var h, g = a.extend(!0, {}, k.data[b]);
            return ea(c) || (c = c.split(g.delimiter)), f ? (h = g.content.push(c) - 1, g.config[h] = d, g.tags[h] = e) : (h = c.length - 1, g.content = c, g.config = d, g.tags = e), k.data[b] = g, h
        },
        set: function(b, c, d, e, f) {
            var h, i, g = a.extend(!0, {}, k.data[b]);
            if (c && c.length && (ea(c) || (c = c.split(g.delimiter)), i = c.filter(function(a) {
                return null !== a
            }), i.length)) {
                if (void 0 === g.content && (g.content = []), void 0 === g.config && (g.config = []), void 0 === g.tags && (g.tags = []), f) {
                    for (h = 0; h < c.length; h++) c[h] && g.content.push(c[h]);
                    for (h = 0; h < d.length; h++) d[h] && g.config.push(d[h]);
                    for (h = 0; h < e.length; h++) e[h] && g.tags.push(e[h])
                } else g.content = c, g.config = d, g.tags = e;
                k.data[b] = g
            }
        },
        unset: function(a, b) {
            var c = k.count(a);
            if (c) {
                if (1 === c) return k.data[a].content = [], k.data[a].config = [], void(k.data[a].tags = []);
                k.data[a].content[b] = null, k.data[a].config[b] = null, k.data[a].tags[b] = null
            }
        },
        out: function(a) {
            var d, b = "",
                c = k.data[a],
                e = k.count(a, !0);
            if (0 === e) return {
                content: "",
                caption: ""
            };
            for (var f = 0; f < e; f++) b += k.get(a, f);
            return d = c.msg(k.count(a)), {
                content: '<div class="file-initial-thumbs">' + b + "</div>",
                caption: d
            }
        },
        footer: function(a, b, c, d) {
            var e = k.data[a];
            if (c = void 0 === c || c, 0 === e.config.length || da(e.config[b])) return "";
            var f = e.config[b],
                g = fa("caption", f),
                h = fa("width", f, "auto"),
                i = fa("url", f, !1),
                j = fa("key", f, null),
                l = fa("showDelete", f, !0),
                m = fa("showZoom", f, e.showZoom),
                n = fa("showDrag", f, e.showDrag),
                o = i === !1 && c,
                p = e.isDelete ? e.actions(!1, l, m, n, o, i, j) : "",
                q = e.footer.replace(/\{actions}/g, p);
            return q.replace(/\{caption}/g, g).replace(/\{size}/g, e.getSize(d)).replace(/\{width}/g, h).replace(/\{indicator}/g, "").replace(/\{indicatorTitle}/g, "")
        }
    }, l = function(a, b) {
        return b = b || 0, "number" == typeof a ? a : ("string" == typeof a && (a = parseFloat(a)), isNaN(a) ? b : a)
    }, m = function() {
        return !(!window.File || !window.FileReader)
    }, n = function() {
        var a = document.createElement("div");
        return !i(9) && (void 0 !== a.draggable || void 0 !== a.ondragstart && void 0 !== a.ondrop)
    }, o = function() {
        return m() && window.FormData
    }, p = function(a, b) {
        a.removeClass(b).addClass(b)
    }, X = {
        showRemove: !0,
        showUpload: !0,
        showZoom: !0,
        showDrag: !0,
        removeIcon: '<i class="glyphicon glyphicon-trash text-danger"></i>',
        removeClass: "btn btn-xs btn-default",
        removeTitle: "删除图片",
        uploadIcon: '<i class="glyphicon glyphicon-upload text-info"></i>',
        uploadClass: "btn btn-xs btn-default",
        uploadTitle: "上传图片",
        zoomIcon: '<i class="glyphicon glyphicon-zoom-in"></i>',
        zoomClass: "btn btn-xs btn-default",
        zoomTitle: "放大浏览",
        dragIcon: '<i class="glyphicon glyphicon-menu-hamburger"></i>',
        dragClass: "text-info",
        dragTitle: "Move / Rearrange",
        dragSettings: {},
        indicatorNew: '<i class="glyphicon glyphicon-hand-down text-warning"></i>',
        indicatorSuccess: '<i class="glyphicon glyphicon-ok-sign text-success"></i>',
        indicatorError: '<i class="glyphicon glyphicon-exclamation-sign text-danger"></i>',
        indicatorLoading: '<i class="glyphicon glyphicon-hand-up text-muted"></i>',
        indicatorNewTitle: "文件没上传",
        indicatorSuccessTitle: "Uploaded",
        indicatorErrorTitle: "Upload Error",
        indicatorLoadingTitle: "Uploading ..."
    }, q = '{preview}\n<div class="kv-upload-progress hide"></div>\n<div class="input-group {class}">\n   {caption}\n   <div class="input-group-btn">\n       {remove}\n       {cancel}\n       {upload}\n       {browse}\n   </div>\n</div>', r = '{preview}\n<div class="kv-upload-progress hide"></div>\n{remove}\n{cancel}\n{upload}\n{browse}\n', s = '<div class="file-preview {class}">\n    {close}    <div class="{dropClass}">\n    <div class="file-preview-thumbnails">\n    </div>\n    <div class="clearfix"></div>    <div class="file-preview-status text-center text-success"></div>\n    <div class="kv-fileinput-error"></div>\n    </div>\n</div>', u = '<div class="close fileinput-remove">&times;</div>\n', t = '<i class="glyphicon glyphicon-file kv-caption-icon"></i>', v = '<div tabindex="500" class="form-control file-caption {class}">\n   <div class="file-caption-name"></div>\n</div>\n', w = '<button type="{type}" tabindex="500" title="{title}" class="{css}" {status}>{icon} {label}</button>', x = '<a href="{href}" tabindex="500" title="{title}" class="{css}" {status}>{icon} {label}</a>', y = '<div tabindex="500" class="{css}" {status}>{icon} {label}</div>', z = '<div id="' + c + '" class="file-zoom-dialog modal fade" tabindex="-1" aria-labelledby="' + c + 'Label"></div>', A = '<div class="modal-dialog modal-lg" role="document">\n  <div class="modal-content">\n    <div class="modal-header">\n      <div class="kv-zoom-actions pull-right">{toggleheader}{fullscreen}{borderless}{close}</div>\n      <h3 class="modal-title">{heading} <small><span class="kv-zoom-title"></span></small></h3>\n    </div>\n    <div class="modal-body">\n      <div class="floating-buttons"></div>\n      <div class="kv-zoom-body file-zoom-content"></div>\n{prev} {next}\n    </div>\n  </div>\n</div>\n', B = '<div class="progress">\n    <div class="{class}" role="progressbar" aria-valuenow="{percent}" aria-valuemin="0" aria-valuemax="100" style="width:{percent}%;">\n        {percent}%\n     </div>\n</div>', C = " <br><samp>({sizeText})</samp>", D = '<div class="file-thumbnail-footer">\n    <div class="file-footer-caption" title="{caption}">{caption}{size}</div>\n    {progress} {actions}\n</div>', E = '<div class="file-actions">\n    <div class="file-footer-buttons">\n        {upload} {delete} {zoom} {other}    </div>\n    {drag}\n    <div class="file-upload-indicator" title="{indicatorTitle}">{indicator}</div>\n    <div class="clearfix"></div>\n</div>', F = '<button type="button" class="kv-file-remove {removeClass}" title="{removeTitle}" {dataUrl}{dataKey}>{removeIcon}</button>\n', G = '<button type="button" class="kv-file-upload {uploadClass}" title="{uploadTitle}">{uploadIcon}</button>', H = '<button type="button" class="kv-file-zoom {zoomClass}" title="{zoomTitle}">{zoomIcon}</button>', I = '<span class="file-drag-handle {dragClass}" title="{dragTitle}">{dragIcon}</span>', J = '<div class="file-preview-frame{frameClass}" id="{previewId}" data-fileindex="{fileindex}" data-template="{template}"', K = J + '><div class="kv-file-content">\n', L = J + ' title="{caption}" ' + d + '><div class="kv-file-content">\n', M = "</div>{footer}\n</div>\n", N = "{content}\n", O = '<div class="kv-preview-data file-preview-html" title="{caption}" ' + d + ">{data}</div>\n", P = '<img src="{data}" class="kv-preview-data file-preview-image" title="{caption}" alt="{caption}" ' + d + ">\n", Q = '<textarea class="kv-preview-data file-preview-text" title="{caption}" readonly ' + d + ">{data}</textarea>\n", R = '<video class="kv-preview-data" width="{width}" height="{height}" controls>\n<source src="{data}" type="{type}">\n' + f + "\n</video>\n", S = '<audio class="kv-preview-data" controls>\n<source src="{data}" type="{type}">\n' + f + "\n</audio>\n", T = '<object class="kv-preview-data file-object" type="application/x-shockwave-flash" width="{width}" height="{height}" data="{data}">\n' + e + " " + f + "\n</object>\n", U = '<object class="kv-preview-data file-object" data="{data}" type="{type}" width="{width}" height="{height}">\n<param name="movie" value="{caption}" />\n' + e + " " + f + "\n</object>\n", V = '<embed class="kv-preview-data" src="{data}" width="{width}" height="{height}" type="application/pdf">\n', W = '<div class="kv-preview-data file-preview-other-frame">\n' + f + "\n</div>\n", Y = {
        main1: q,
        main2: r,
        preview: s,
        close: u,
        fileIcon: t,
        caption: v,
        modalMain: z,
        modal: A,
        progress: B,
        size: C,
        footer: D,
        actions: E,
        actionDelete: F,
        actionUpload: G,
        actionZoom: H,
        actionDrag: I,
        btnDefault: w,
        btnLink: x,
        btnBrowse: y
    }, Z = {
        generic: K + N + M,
        html: K + O + M,
        image: K + P + M,
        text: K + Q + M,
        video: L + R + M,
        audio: L + S + M,
        flash: L + T + M,
        object: L + U + M,
        pdf: L + V + M,
        other: L + W + M
    }, _ = ["image", "html", "text", "video", "audio", "flash", "pdf", "object"], ba = {
        image: {
            width: "auto",
            height: "100px"
        },
        html: {
            width: "213px",
            height: "100px"
        },
        text: {
            width: "213px",
            height: "100px"
        },
        video: {
            width: "213px",
            height: "100px"
        },
        audio: {
            width: "213px",
            height: "80px"
        },
        flash: {
            width: "213px",
            height: "100px"
        },
        object: {
            width: "100px",
            height: "100px"
        },
        pdf: {
            width: "100px",
            height: "100px"
        },
        other: {
            width: "100px",
            height: "100px"
        }
    }, $ = {
        image: {
            width: "100%",
            height: "100%"
        },
        html: {
            width: "100%",
            height: "100%",
            "min-height": "480px"
        },
        text: {
            width: "100%",
            height: "100%",
            "min-height": "480px"
        },
        video: {
            width: "auto",
            height: "100%",
            "max-width": "100%"
        },
        audio: {
            width: "100%",
            height: "30px"
        },
        flash: {
            width: "auto",
            height: "480px"
        },
        object: {
            width: "auto",
            height: "100%",
            "min-height": "480px"
        },
        pdf: {
            width: "100%",
            height: "100%",
            "min-height": "480px"
        },
        other: {
            width: "auto",
            height: "100%",
            "min-height": "480px"
        }
    }, ca = {
        image: function(a, b) {
            return h(a, "image.*") || h(b, /\.(gif|png|jpe?g)$/i)
        },
        html: function(a, b) {
            return h(a, "text/html") || h(b, /\.(htm|html)$/i)
        },
        text: function(a, b) {
            return h(a, "text.*") || h(b, /\.(xml|javascript)$/i) || h(b, /\.(txt|md|csv|nfo|ini|json|php|js|css)$/i)
        },
        video: function(a, b) {
            return h(a, "video.*") && (h(a, /(ogg|mp4|mp?g|webm|3gp)$/i) || h(b, /\.(og?|mp4|webm|mp?g|3gp)$/i))
        },
        audio: function(a, b) {
            return h(a, "audio.*") && (h(b, /(ogg|mp3|mp?g|wav)$/i) || h(b, /\.(og?|mp3|mp?g|wav)$/i))
        },
        flash: function(a, b) {
            return h(a, "application/x-shockwave-flash", !0) || h(b, /\.(swf)$/i)
        },
        pdf: function(a, b) {
            return h(a, "application/pdf", !0) || h(b, /\.(pdf)$/i)
        },
        object: function() {
            return !0
        },
        other: function() {
            return !0
        }
    }, da = function(b, c) {
        return void 0 === b || null === b || 0 === b.length || c && "" === a.trim(b)
    }, ea = function(a) {
        return Array.isArray(a) || "[object Array]" === Object.prototype.toString.call(a)
    }, fa = function(a, b, c) {
        return c = c || "", b && "object" == typeof b && a in b ? b[a] : c
    }, aa = function(b, c, d) {
        return da(b) || da(b[c]) ? d : a(b[c])
    }, ga = function() {
        return Math.round((new Date).getTime() + 100 * Math.random())
    }, ha = function(a) {
        return a.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&apos;")
    }, ia = function(b, c) {
        var d = b;
        return c ? (a.each(c, function(a, b) {
            "function" == typeof b && (b = b()), d = d.split(a).join(b)
        }), d) : d
    }, ja = function(a) {
        var b = a.is("img") ? a.attr("src") : a.find("source").attr("src");
        g.revokeObjectURL(b)
    }, ka = function(a) {
        var b = a.lastIndexOf("/");
        return b === -1 && (b = a.lastIndexOf("\\")), a.split(a.substring(b, b + 1)).pop()
    }, la = function() {
        return document.fullscreenElement || document.mozFullScreenElement || document.webkitFullscreenElement || document.msFullscreenElement
    }, ma = function(a) {
        a && !la() ? document.documentElement.requestFullscreen ? document.documentElement.requestFullscreen() : document.documentElement.msRequestFullscreen ? document.documentElement.msRequestFullscreen() : document.documentElement.mozRequestFullScreen ? document.documentElement.mozRequestFullScreen() : document.documentElement.webkitRequestFullscreen && document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT) : document.exitFullscreen ? document.exitFullscreen() : document.msExitFullscreen ? document.msExitFullscreen() : document.mozCancelFullScreen ? document.mozCancelFullScreen() : document.webkitExitFullscreen && document.webkitExitFullscreen()
    }, na = function(a, b, c) {
        if (c >= a.length)
            for (var d = c - a.length; d--+1;) a.push(void 0);
        return a.splice(c, 0, a.splice(b, 1)[0]), a
    }, oa = function(b, c) {
        var d = this;
        d.$element = a(b), d._validate() && (d.isPreviewable = m(), d.isIE9 = i(9), d.isIE10 = i(10), d.isPreviewable || d.isIE9 ? (d._init(c), d._listen()) : d.$element.removeClass("file-loading"))
    }, oa.prototype = {
        constructor: oa,
        _init: function(b) {
            var e, c = this,
                d = c.$element;
            a.each(b, function(a, b) {
                switch (a) {
                    case "minFileCount":
                    case "maxFileCount":
                    case "maxFileSize":
                        c[a] = l(b);
                        break;
                    default:
                        c[a] = b
                }
            }), c.fileInputCleared = !1, c.fileBatchCompleted = !0, c.isPreviewable || (c.showPreview = !1), c.uploadFileAttr = da(d.attr("name")) ? "file_data" : d.attr("name"), c.reader = null, c.formdata = {}, c.clearStack(), c.uploadCount = 0, c.uploadStatus = {}, c.uploadLog = [], c.uploadAsyncCount = 0, c.loadedImages = [], c.totalImagesCount = 0, c.ajaxRequests = [], c.isError = !1, c.ajaxAborted = !1, c.cancelling = !1, e = c._getLayoutTemplate("progress"), c.progressTemplate = e.replace("{class}", c.progressClass), c.progressCompleteTemplate = e.replace("{class}", c.progressCompleteClass), c.progressErrorTemplate = e.replace("{class}", c.progressErrorClass), c.dropZoneEnabled = n() && c.dropZoneEnabled, c.isDisabled = c.$element.attr("disabled") || c.$element.attr("readonly"), c.isUploadable = o() && !da(c.uploadUrl), c.isClickable = c.browseOnZoneClick && c.showPreview && (c.isUploadable && c.dropZoneEnabled || !da(c.defaultPreviewContent)), c.slug = "function" == typeof b.slugCallback ? b.slugCallback : c._slugDefault, c.mainTemplate = c.showCaption ? c._getLayoutTemplate("main1") : c._getLayoutTemplate("main2"), c.captionTemplate = c._getLayoutTemplate("caption"), c.previewGenericTemplate = c._getPreviewTemplate("generic"), c.resizeImage && (c.maxImageWidth || c.maxImageHeight) && (c.imageCanvas = document.createElement("canvas"), c.imageCanvasContext = c.imageCanvas.getContext("2d")), da(c.$element.attr("id")) && c.$element.attr("id", ga()), void 0 === c.$container ? c.$container = c._createContainer() : c._refreshContainer(), c.$dropZone = c.$container.find(".file-drop-zone"), c.$progress = c.$container.find(".kv-upload-progress"), c.$btnUpload = c.$container.find(".fileinput-upload"), c.$captionContainer = aa(b, "elCaptionContainer", c.$container.find(".file-caption")), c.$caption = aa(b, "elCaptionText", c.$container.find(".file-caption-name")), c.$previewContainer = aa(b, "elPreviewContainer", c.$container.find(".file-preview")), c.$preview = aa(b, "elPreviewImage", c.$container.find(".file-preview-thumbnails")), c.$previewStatus = aa(b, "elPreviewStatus", c.$container.find(".file-preview-status")), c.$errorContainer = aa(b, "elErrorContainer", c.$previewContainer.find(".kv-fileinput-error")), da(c.msgErrorClass) || p(c.$errorContainer, c.msgErrorClass), c.$errorContainer.hide(), c.fileActionSettings = a.extend(!0, X, b.fileActionSettings), c.previewInitId = "preview-" + ga(), c.id = c.$element.attr("id"), k.init(c), c._initPreview(!0), c._initPreviewActions(), c.options = b, c._setFileDropZoneTitle(), c.$element.removeClass("file-loading"), c.$element.attr("disabled") && c.disable(), c._initZoom()
        },
        _validate: function() {
            var b, a = this;
            return "file" === a.$element.attr("type") || (b = '<div class="help-block alert alert-warning"><h4>Invalid Input Type</h4>You must set an input <code>type = file</code> for <b>bootstrap-fileinput</b> plugin to initialize.</div>', a.$element.after(b), !1)
        },
        _errorsExist: function() {
            var c, b = this;
            return !!b.$errorContainer.find("li").length || (c = a(document.createElement("div")).html(b.$errorContainer.html()), c.find("span.kv-error-close").remove(), c.find("ul").remove(), !! a.trim(c.text()).length)
        },
        _errorHandler: function(a, b) {
            var c = this,
                d = a.target.error;
            d.code === d.NOT_FOUND_ERR ? c._showError(c.msgFileNotFound.replace("{name}", b)) : d.code === d.SECURITY_ERR ? c._showError(c.msgFileSecured.replace("{name}", b)) : d.code === d.NOT_READABLE_ERR ? c._showError(c.msgFileNotReadable.replace("{name}", b)) : d.code === d.ABORT_ERR ? c._showError(c.msgFilePreviewAborted.replace("{name}", b)) : c._showError(c.msgFilePreviewError.replace("{name}", b))
        },
        _addError: function(a) {
            var b = this,
                c = b.$errorContainer;
            a && c.length && (c.html(b.errorCloseButton + a), j(c.find(".kv-error-close"), "click", function() {
                c.fadeOut("slow")
            }))
        },
        _resetErrors: function(a) {
            var b = this,
                c = b.$errorContainer;
            b.isError = !1, b.$container.removeClass("has-error"), c.html(""), a ? c.fadeOut("slow") : c.hide()
        },
        _showFolderError: function(a) {
            var d, b = this,
                c = b.$errorContainer;
            a && (d = b.msgFoldersNotAllowed.replace(/\{n}/g, a), b._addError(d), p(b.$container, "has-error"), c.fadeIn(800), b._raise("filefoldererror", [a, d]))
        },
        _showUploadError: function(a, b, c) {
            var d = this,
                e = d.$errorContainer,
                f = c || "fileuploaderror",
                g = b && b.id ? '<li data-file-id="' + b.id + '">' + a + "</li>" : "<li>" + a + "</li>";
            return 0 === e.find("ul").length ? d._addError("<ul>" + g + "</ul>") : e.find("ul").append(g), e.fadeIn(800), d._raise(f, [b, a]), d.$container.removeClass("file-input-new"), p(d.$container, "has-error"), !0
        },
        _showError: function(a, b, c) {
            var d = this,
                e = d.$errorContainer,
                f = c || "fileerror";
            return b = b || {}, b.reader = d.reader, d._addError(a), e.fadeIn(800), d._raise(f, [b, a]), d.isUploadable || d._clearFileInput(), d.$container.removeClass("file-input-new"), p(d.$container, "has-error"), d.$btnUpload.attr("disabled", !0), !0
        },
        _noFilesError: function(a) {
            var b = this,
                c = b.minFileCount > 1 ? b.filePlural : b.fileSingle,
                d = b.msgFilesTooLess.replace("{n}", b.minFileCount).replace("{files}", c),
                e = b.$errorContainer;
            b._addError(d), b.isError = !0, b._updateFileDetails(0), e.fadeIn(800), b._raise("fileerror", [a, d]), b._clearFileInput(), p(b.$container, "has-error")
        },
        _parseError: function(b, c, d) {
            var e = this,
                f = a.trim(c + ""),
                g = "." === f.slice(-1) ? "" : ".",
                h = void 0 !== b.responseJSON && void 0 !== b.responseJSON.error ? b.responseJSON.error : b.responseText;
            return e.cancelling && e.msgUploadAborted && (f = e.msgUploadAborted), e.showAjaxErrorDetails && h ? (h = a.trim(h.replace(/\n\s*\n/g, "\n")), h = h.length > 0 ? "<pre>" + h + "</pre>" : "", f += g + h) : f += g, e.cancelling = !1, d ? "<b>" + d + ": </b>" + f : f
        },
        _parseFileType: function(a) {
            var c, d, e, f, b = this;
            for (f = 0; f < _.length; f += 1)
                if (e = _[f], c = fa(e, b.fileTypeSettings, ca[e]), d = c(a.type, a.name) ? e : "", !da(d)) return d;
            return "other"
        },
        _parseFilePreviewIcon: function(b, c) {
            var e, f, d = this,
                g = d.previewFileIcon;
            return c && c.indexOf(".") > -1 && (f = c.split(".").pop(), d.previewFileIconSettings && d.previewFileIconSettings[f] && (g = d.previewFileIconSettings[f]), d.previewFileExtSettings && a.each(d.previewFileExtSettings, function(a, b) {
                return d.previewFileIconSettings[a] && b(f) ? void(g = d.previewFileIconSettings[a]) : void(e = !0)
            })), b.indexOf("{previewFileIcon}") > -1 ? b.replace(/\{previewFileIconClass}/g, d.previewFileIconClass).replace(/\{previewFileIcon}/g, g) : b
        },
        _raise: function(b, c) {
            var d = this,
                e = a.Event(b);
            if (void 0 !== c ? d.$element.trigger(e, c) : d.$element.trigger(e), e.isDefaultPrevented()) return !1;
            if (!e.result) return e.result;
            switch (b) {
                case "filebatchuploadcomplete":
                case "filebatchuploadsuccess":
                case "fileuploaded":
                case "fileclear":
                case "filecleared":
                case "filereset":
                case "fileerror":
                case "filefoldererror":
                case "fileuploaderror":
                case "filebatchuploaderror":
                case "filedeleteerror":
                case "filecustomerror":
                case "filesuccessremove":
                    break;
                default:
                    d.ajaxAborted = e.result
            }
            return !0
        },
        _listenFullScreen: function(a) {
            var d, e, b = this,
                c = b.$modal;
            c && c.length && (d = c && c.find(".btn-fullscreen"), e = c && c.find(".btn-borderless"), d.length && e.length && (d.removeClass("active").attr("aria-pressed", "false"), e.removeClass("active").attr("aria-pressed", "false"), a ? d.addClass("active").attr("aria-pressed", "true") : e.addClass("active").attr("aria-pressed", "true"), c.hasClass("file-zoom-fullscreen") ? b._maximizeZoomDialog() : a ? b._maximizeZoomDialog() : e.removeClass("active").attr("aria-pressed", "false")))
        },
        _listen: function() {
            var b = this,
                c = b.$element,
                d = c.closest("form"),
                e = b.$container;
            j(c, "change", a.proxy(b._change, b)), b.showBrowse && j(b.$btnFile, "click", a.proxy(b._browse, b)), j(d, "reset", a.proxy(b.reset, b)), j(e.find(".fileinput-remove:not([disabled])"), "click", a.proxy(b.clear, b)), j(e.find(".fileinput-cancel"), "click", a.proxy(b.cancel, b)), b._initDragDrop(), b.isUploadable || j(d, "submit", a.proxy(b._submitForm, b)), j(b.$container.find(".fileinput-upload"), "click", a.proxy(b._uploadClick, b)), j(a(window), "resize", function() {
                b._listenFullScreen(screen.width === window.innerWidth && screen.height === window.innerHeight)
            }), j(a(document), "webkitfullscreenchange mozfullscreenchange fullscreenchange MSFullscreenChange", function() {
                b._listenFullScreen(la())
            }), b._initClickable()
        },
        _initClickable: function() {
            var c, b = this;
            b.isClickable && (c = b.isUploadable ? b.$dropZone : b.$preview.find(".file-default-preview"), p(c, "clickable"), c.attr("tabindex", -1), j(c, "click", function(d) {
                var e = a(d.target);
                e.parents(".file-preview-thumbnails").length && !e.parents(".file-default-preview").length || (b.$element.trigger("click"), c.blur())
            }))
        },
        _initDragDrop: function() {
            var b = this,
                c = b.$dropZone;
            b.isUploadable && b.dropZoneEnabled && b.showPreview && (j(c, "dragenter dragover", a.proxy(b._zoneDragEnter, b)), j(c, "dragleave", a.proxy(b._zoneDragLeave, b)), j(c, "drop", a.proxy(b._zoneDrop, b)), j(a(document), "dragenter dragover drop", b._zoneDragDropInit))
        },
        _zoneDragDropInit: function(a) {
            a.stopPropagation(), a.preventDefault()
        },
        _zoneDragEnter: function(b) {
            var c = this,
                d = a.inArray("Files", b.originalEvent.dataTransfer.types) > -1;
            return c._zoneDragDropInit(b), c.isDisabled || !d ? (b.originalEvent.dataTransfer.effectAllowed = "none", void(b.originalEvent.dataTransfer.dropEffect = "none")) : void p(c.$dropZone, "file-highlighted")
        },
        _zoneDragLeave: function(a) {
            var b = this;
            b._zoneDragDropInit(a), b.isDisabled || b.$dropZone.removeClass("file-highlighted")
        },
        _zoneDrop: function(a) {
            var b = this;
            a.preventDefault(), b.isDisabled || da(a.originalEvent.dataTransfer.files) || (b._change(a, "dragdrop"), b.$dropZone.removeClass("file-highlighted"))
        },
        _uploadClick: function(a) {
            var d, b = this,
                c = b.$container.find(".fileinput-upload"),
                e = !c.hasClass("disabled") && da(c.attr("disabled"));
            if (!a || !a.isDefaultPrevented()) {
                if (!b.isUploadable) return void(e && "submit" !== c.attr("type") && (d = c.closest("form"), d.length && d.trigger("submit"), a.preventDefault()));
                a.preventDefault(), e && b.upload()
            }
        },
        _submitForm: function() {
            var a = this,
                b = a.$element,
                c = b.get(0).files;
            return c && a.minFileCount > 0 && a._getFileCount(c.length) < a.minFileCount ? (a._noFilesError({}), !1) : !a._abort({})
        },
        _clearPreview: function() {
            var a = this,
                b = a.showUploadedThumbs ? a.$preview.find(".file-preview-frame:not(.file-preview-success)") : a.$preview.find(".file-preview-frame");
            b.remove(), a.$preview.find(".file-preview-frame").length && a.showPreview || a._resetUpload(), a._validateDefaultPreview()
        },
        _initSortable: function() {
            var d, e, b = this,
                c = b.$preview;
            window.KvSortable && (d = c.find(".file-initial-thumbs"), e = {
                handle: ".drag-handle-init",
                dataIdAttr: "data-preview-id",
                draggable: ".file-preview-initial",
                onSort: function(c) {
                    var d = c.oldIndex,
                        e = c.newIndex;
                    b.initialPreview = na(b.initialPreview, d, e), b.initialPreviewConfig = na(b.initialPreviewConfig, d, e), k.init(b), b._raise("filesorted", {
                        previewId: a(c.item).attr("id"),
                        oldIndex: d,
                        newIndex: e,
                        stack: b.initialPreviewConfig
                    })
                }
            }, d.data("kvsortable") && d.kvsortable("destroy"), a.extend(!0, e, b.fileActionSettings.dragSettings), d.kvsortable(e))
        },
        _initPreview: function(a) {
            var d, b = this,
                c = b.initialCaption || "";
            return k.count(b.id) ? (d = k.out(b.id), c = a && b.initialCaption ? b.initialCaption : d.caption, b.$preview.html(d.content), b._setCaption(c), b._initSortable(), void(da(d.content) || b.$container.removeClass("file-input-new"))) : (b._clearPreview(), void(a ? b._setCaption(c) : b._initCaption()))
        },
        _getZoomButton: function(a) {
            var b = this,
                c = b.previewZoomButtonIcons[a],
                d = b.previewZoomButtonClasses[a],
                e = ' title="' + (b.previewZoomButtonTitles[a] || "") + '" ',
                f = e + ("close" === a ? ' data-dismiss="modal" aria-hidden="true"' : "");
            return "fullscreen" !== a && "borderless" !== a && "toggleheader" !== a || (f += ' data-toggle="button" aria-pressed="false" autocomplete="off"'), '<button type="button" class="' + d + " btn-" + a + '"' + f + ">" + c + "</button>"
        },
        _getModalContent: function() {
            var a = this;
            return a._getLayoutTemplate("modal").replace(/\{heading}/g, a.msgZoomModalHeading).replace(/\{prev}/g, a._getZoomButton("prev")).replace(/\{next}/g, a._getZoomButton("next")).replace(/\{toggleheader}/g, a._getZoomButton("toggleheader")).replace(/\{fullscreen}/g, a._getZoomButton("fullscreen")).replace(/\{borderless}/g, a._getZoomButton("borderless")).replace(/\{close}/g, a._getZoomButton("close"))
        },
        _listenModalEvent: function(a) {
            var b = this,
                c = b.$modal,
                d = function(a) {
                    return {
                        sourceEvent: a,
                        previewId: c.data("previewId"),
                        modal: c
                    }
                };
            c.on(a + ".bs.modal", function(e) {
                var f = c.find(".btn-fullscreen"),
                    g = c.find(".btn-borderless");
                b._raise("filezoom" + a, d(e)), "shown" === a && (g.removeClass("active").attr("aria-pressed", "false"), f.removeClass("active").attr("aria-pressed", "false"), c.hasClass("file-zoom-fullscreen") && (b._maximizeZoomDialog(), la() ? f.addClass("active").attr("aria-pressed", "true") : g.addClass("active").attr("aria-pressed", "true")))
            })
        },
        _initZoom: function() {
            var d, b = this,
                e = b._getLayoutTemplate("modalMain"),
                f = "#" + c;
            b.$modal = a(f), b.$modal && b.$modal.length || (d = a(document.createElement("div")).html(e).insertAfter(b.$container), b.$modal = a("#" + c).insertBefore(d), d.remove()), b.$modal.html(b._getModalContent()), b._listenModalEvent("show"), b._listenModalEvent("shown"), b._listenModalEvent("hide"), b._listenModalEvent("hidden"), b._listenModalEvent("loaded")
        },
        _initZoomButtons: function() {
            var d, e, b = this,
                c = b.$modal.data("previewId") || "",
                f = b.$preview.find(".file-preview-frame").toArray(),
                g = f.length,
                h = b.$modal.find(".btn-prev"),
                i = b.$modal.find(".btn-next");
            g && (d = a(f[0]), e = a(f[g - 1]), h.removeAttr("disabled"), i.removeAttr("disabled"), d.length && d.attr("id") === c && h.attr("disabled", !0), e.length && e.attr("id") === c && i.attr("disabled", !0))
        },
        _maximizeZoomDialog: function() {
            var b = this,
                c = b.$modal,
                d = c.find(".modal-header:visible"),
                e = c.find(".modal-footer:visible"),
                f = c.find(".modal-body"),
                g = a(window).height(),
                h = 0;
            c.addClass("file-zoom-fullscreen"), d && d.length && (g -= d.outerHeight(!0)), e && e.length && (g -= e.outerHeight(!0)), f && f.length && (h = f.outerHeight(!0) - f.height(), g -= h), c.find(".kv-zoom-body").height(g)
        },
        _resizeZoomDialog: function(a) {
            var b = this,
                c = b.$modal,
                d = c.find(".btn-fullscreen"),
                e = c.find(".btn-borderless");
            if (c.hasClass("file-zoom-fullscreen")) ma(!1), a ? d.hasClass("active") || (c.removeClass("file-zoom-fullscreen"), b._resizeZoomDialog(!0), e.hasClass("active") && e.removeClass("active").attr("aria-pressed", "false")) : d.hasClass("active") ? d.removeClass("active").attr("aria-pressed", "false") : (c.removeClass("file-zoom-fullscreen"), b.$modal.find(".kv-zoom-body").css("height", b.zoomModalHeight));
            else {
                if (!a) return void b._maximizeZoomDialog();
                ma(!0)
            }
            c.focus()
        },
        _setZoomContent: function(b, c) {
            var e, f, g, h, i, k, l, r, d = this,
                m = b.attr("id"),
                n = d.$modal,
                o = n.find(".btn-prev"),
                q = n.find(".btn-next"),
                s = n.find(".btn-fullscreen"),
                t = n.find(".btn-borderless"),
                u = n.find(".btn-toggleheader");
            f = b.data("template") || "generic", e = b.find(".kv-file-content"), g = e.length ? e.html() : "", h = b.find(".file-footer-caption").text() || "", n.find(".kv-zoom-title").html(h), i = n.find(".kv-zoom-body"), c ? (r = i.clone().insertAfter(i), i.html(g).hide(), r.fadeOut("fast", function() {
                i.fadeIn("fast"), r.remove()
            })) : i.html(g), l = d.previewZoomSettings[f], l && (k = i.find(".kv-preview-data"), p(k, "file-zoom-detail"), a.each(l, function(a, b) {
                k.css(a, b), (k.attr("width") && "width" === a || k.attr("height") && "height" === a) && k.removeAttr(a)
            })), n.data("previewId", m), j(o, "click", function() {
                d._zoomSlideShow("prev", m)
            }), j(q, "click", function() {
                d._zoomSlideShow("next", m)
            }), j(s, "click", function() {
                d._resizeZoomDialog(!0)
            }), j(t, "click", function() {
                d._resizeZoomDialog(!1)
            }), j(u, "click", function() {
                var c, a = n.find(".modal-header"),
                    b = n.find(".modal-body .floating-buttons"),
                    e = a.find(".kv-zoom-actions"),
                    f = function(b) {
                        var c = d.$modal.find(".kv-zoom-body"),
                            e = d.zoomModalHeight;
                        n.hasClass("file-zoom-fullscreen") && (e = c.outerHeight(!0), b || (e -= a.outerHeight(!0))), c.css("height", b ? e + b : e)
                    };
                a.is(":visible") ? (c = a.outerHeight(!0), a.slideUp("slow", function() {
                    e.find(".btn").appendTo(b), f(c)
                })) : (b.find(".btn").appendTo(e), a.slideDown("slow", function() {
                    f()
                })), n.focus()
            }), j(n, "keydown", function(a) {
                var b = a.which || a.keyCode;
                37 !== b || o.attr("disabled") || d._zoomSlideShow("prev", m), 39 !== b || q.attr("disabled") || d._zoomSlideShow("next", m)
            })
        },
        _zoomPreview: function(a) {
            var c, b = this;
            if (!a.length) throw "Cannot zoom to detailed preview!";
            b.$modal.html(b._getModalContent()), c = a.closest(".file-preview-frame"), b._setZoomContent(c), b.$modal.modal("show"), b._initZoomButtons()
        },
        _zoomSlideShow: function(b, c) {
            var f, g, j, d = this,
                e = d.$modal.find(".kv-zoom-actions .btn-" + b),
                h = d.$preview.find(".file-preview-frame").toArray(),
                i = h.length;
            if (!e.attr("disabled")) {
                for (g = 0; g < i; g++)
                    if (a(h[g]).attr("id") === c) {
                        j = "prev" === b ? g - 1 : g + 1;
                        break
                    }
                j < 0 || j >= i || !h[j] || (f = a(h[j]), f.length && d._setZoomContent(f, !0), d._initZoomButtons(), d._raise("filezoom" + b, {
                    previewId: c,
                    modal: d.$modal
                }))
            }
        },
        _initZoomButton: function() {
            var b = this;
            b.$preview.find(".kv-file-zoom").each(function() {
                var c = a(this);
                j(c, "click", function() {
                    b._zoomPreview(c)
                })
            })
        },
        _initPreviewActions: function() {
            var b = this,
                c = b.deleteExtraData || {}, d = function() {
                    var a = b.isUploadable ? k.count(b.id) : b.$element.get(0).files.length;
                    0 !== b.$preview.find(".kv-file-remove").length || a || (b.reset(), b.initialCaption = "")
                };
            b._initZoomButton(), b.$preview.find(".kv-file-remove").each(function() {
                var e = a(this),
                    f = e.data("url") || b.deleteUrl,
                    g = e.data("key");
                if (!da(f) && void 0 !== g) {
                    var l, m, o, q, h = e.closest(".file-preview-frame"),
                        i = k.data[b.id],
                        n = h.data("fileindex");
                    n = parseInt(n.replace("init_", "")), o = da(i.config) && da(i.config[n]) ? null : i.config[n], q = da(o) || da(o.extra) ? c : o.extra, "function" == typeof q && (q = q()), m = {
                        id: e.attr("id"),
                        key: g,
                        extra: q
                    }, l = a.extend(!0, {}, {
                        url: f,
                        type: "POST",
                        dataType: "json",
                        data: a.extend(!0, {}, {
                            key: g
                        }, q),
                        beforeSend: function(a) {
                            b.ajaxAborted = !1, b._raise("filepredelete", [g, a, q]), b.ajaxAborted ? a.abort() : (p(h, "file-uploading"), p(e, "disabled"))
                        },
                        success: function(a, c, f) {
                            var i, j;
                            return da(a) || da(a.error) ? (k.unset(b.id, n), i = k.count(b.id), j = i > 0 ? b._getMsgSelected(i) : "", b._raise("filedeleted", [g, f, q]), b._setCaption(j), h.removeClass("file-uploading").addClass("file-deleted"), void h.fadeOut("slow", function() {
                                b._clearObjects(h), h.remove(), d(), i || 0 !== b.getFileStack().length || (b._setCaption(""), b.reset())
                            })) : (m.jqXHR = f, m.response = a, b._showError(a.error, m, "filedeleteerror"), h.removeClass("file-uploading"), e.removeClass("disabled"), void d())
                        },
                        error: function(a, c, e) {
                            var f = b._parseError(a, e);
                            m.jqXHR = a, m.response = {}, b._showError(f, m, "filedeleteerror"), h.removeClass("file-uploading"), d()
                        }
                    }, b.ajaxDeleteSettings), j(e, "click", function() {
                        return !!b._validateMinCount() && void a.ajax(l)
                    })
                }
            })
        },
        _clearObjects: function(b) {
            b.find("video audio").each(function() {
                this.pause(), a(this).remove()
            }), b.find("img object div").each(function() {
                a(this).remove()
            })
        },
        _clearFileInput: function() {
            var d, e, f, b = this,
                c = b.$element;
            b.fileInputCleared = !0, da(c.val()) || (b.isIE9 || b.isIE10 ? (d = c.closest("form"), e = a(document.createElement("form")), f = a(document.createElement("div")), c.before(f), d.length ? d.after(e) : f.after(e), e.append(c).trigger("reset"), f.before(c).remove(), e.remove()) : c.val(""))
        },
        _resetUpload: function() {
            var a = this;
            a.uploadCache = {
                content: [],
                config: [],
                tags: [],
                append: !0
            }, a.uploadCount = 0, a.uploadStatus = {}, a.uploadLog = [], a.uploadAsyncCount = 0, a.loadedImages = [], a.totalImagesCount = 0, a.$btnUpload.removeAttr("disabled"), a._setProgress(0), p(a.$progress, "hide"), a._resetErrors(!1), a.ajaxAborted = !1, a.ajaxRequests = [], a._resetCanvas()
        },
        _resetCanvas: function() {
            var a = this;
            a.canvas && a.imageCanvasContext && a.imageCanvasContext.clearRect(0, 0, a.canvas.width, a.canvas.height)
        },
        _hasInitialPreview: function() {
            var a = this;
            return !a.overwriteInitial && k.count(a.id)
        },
        _resetPreview: function() {
            var b, c, a = this;
            k.count(a.id) ? (b = k.out(a.id), a.$preview.html(b.content), c = a.initialCaption ? a.initialCaption : b.caption, a._setCaption(c)) : (a._clearPreview(), a._initCaption()), a.showPreview && (a._initZoom(), a._initSortable())
        },
        _clearDefaultPreview: function() {
            var a = this;
            a.$preview.find(".file-default-preview").remove()
        },
        _validateDefaultPreview: function() {
            var a = this;
            a.showPreview && !da(a.defaultPreviewContent) && (a.$preview.html('<div class="file-default-preview">' + a.defaultPreviewContent + "</div>"), a.$container.removeClass("file-input-new"), a._initClickable())
        },
        _resetPreviewThumbs: function(a) {
            var c, b = this;
            return a ? (b._clearPreview(), void b.clearStack()) : void(b._hasInitialPreview() ? (c = k.out(b.id), b.$preview.html(c.content), b._setCaption(c.caption), b._initPreviewActions()) : b._clearPreview())
        },
        _getLayoutTemplate: function(a) {
            var b = this,
                c = fa(a, b.layoutTemplates, Y[a]);
            return da(b.customLayoutTags) ? c : ia(c, b.customLayoutTags)
        },
        _getPreviewTemplate: function(a) {
            var b = this,
                c = fa(a, b.previewTemplates, Z[a]);
            return da(b.customPreviewTags) ? c : ia(c, b.customPreviewTags)
        },
        _getOutData: function(a, b, c) {
            var d = this;
            return a = a || {}, b = b || {}, c = c || d.filestack.slice(0) || {}, {
                form: d.formdata,
                files: c,
                filenames: d.filenames,
                filescount: d.getFilesCount(),
                extra: d._getExtraData(),
                response: b,
                reader: d.reader,
                jqXHR: a
            }
        },
        _getMsgSelected: function(a) {
            var b = this,
                c = 1 === a ? b.fileSingle : b.filePlural;
            return a > 0 ? b.msgSelected.replace("{n}", a).replace("{files}", c) : b.msgNoFilesSelected
        },
        _getThumbs: function(a) {
            return a = a || "", this.$preview.find(".file-preview-frame:not(.file-preview-initial)" + a)
        },
        _getExtraData: function(a, b) {
            var c = this,
                d = c.uploadExtraData;
            return "function" == typeof c.uploadExtraData && (d = c.uploadExtraData(a, b)), d
        },
        _initXhr: function(a, b, c) {
            var d = this;
            return a.upload && a.upload.addEventListener("progress", function(a) {
                var e = 0,
                    f = a.total,
                    g = a.loaded || a.position;
                a.lengthComputable && (e = Math.floor(g / f * 100)), b ? d._setAsyncUploadStatus(b, e, c) : d._setProgress(e)
            }, !1), a
        },
        _ajaxSubmit: function(b, c, d, e, f, g) {
            var i, h = this;
            h._raise("filepreajax", [f, g]), h._uploadExtra(f, g), i = a.extend(!0, {}, {
                xhr: function() {
                    var b = a.ajaxSettings.xhr();
                    return h._initXhr(b, f, h.getFileStack().length)
                },
                url: h.uploadUrl,
                type: "POST",
                dataType: "json",
                data: h.formdata,
                cache: !1,
                processData: !1,
                contentType: !1,
                beforeSend: b,
                success: c,
                complete: d,
                error: e
            }, h.ajaxSettings), h.ajaxRequests.push(a.ajax(i))
        },
        _initUploadSuccess: function(b, c, d) {
            var f, g, h, i, j, l, m, n, e = this,
                o = function(a, b) {
                    e[a] instanceof Array || (e[a] = []), b && b.length && (e[a] = e[a].concat(b))
                };
            e.showPreview && "object" == typeof b && !a.isEmptyObject(b) && void 0 !== b.initialPreview && b.initialPreview.length > 0 && (e.hasInitData = !0, j = b.initialPreview || [], l = b.initialPreviewConfig || [], m = b.initialPreviewThumbTags || [], f = !(void 0 !== b.append && !b.append), j.length > 0 && !ea(j) && (j = j.split(e.initialPreviewDelimiter)), e.overwriteInitial = !1, o("initialPreview", j), o("initialPreviewConfig", l), o("initialPreviewThumbTags", m), void 0 !== c ? d ? (n = c.attr("data-fileindex"), e.uploadCache.content[n] = j[0], e.uploadCache.config[n] = l[0] || [], e.uploadCache.tags[n] = m[0] || [], e.uploadCache.append = f) : (h = k.add(e.id, j, l[0], m[0], f), g = k.get(e.id, h, !1), i = a(g).hide(), c.after(i).fadeOut("slow", function() {
                i.fadeIn("slow").css("display:inline-block"), e._initPreviewActions(), e._clearFileInput(), c.remove()
            })) : (k.set(e.id, j, l, m, f), e._initPreview(), e._initPreviewActions()))
        },
        _initSuccessThumbs: function() {
            var b = this;
            b.showPreview && b._getThumbs(".file-preview-success").each(function() {
                var c = a(this),
                    d = c.find(".kv-file-remove");
                d.removeAttr("disabled"), j(d, "click", function() {
                    var a = b._raise("filesuccessremove", [c.attr("id"), c.data("fileindex")]);
                    ja(c), a !== !1 && c.fadeOut("slow", function() {
                        c.remove(), b.$preview.find(".file-preview-frame").length || b.reset()
                    })
                })
            })
        },
        _checkAsyncComplete: function() {
            var c, d, b = this;
            for (d = 0; d < b.filestack.length; d++)
                if (b.filestack[d] && (c = b.previewInitId + "-" + d, a.inArray(c, b.uploadLog) === -1)) return !1;
            return b.uploadAsyncCount === b.uploadLog.length
        },
        _uploadExtra: function(b, c) {
            var d = this,
                e = d._getExtraData(b, c);
            0 !== e.length && a.each(e, function(a, b) {
                d.formdata.append(a, b)
            })
        },
        _uploadSingle: function(b, c, d) {
            var h, j, l, m, n, q, r, s, t, u, e = this,
                f = e.getFileStack().length,
                g = new FormData,
                i = e.previewInitId + "-" + b,
                o = e.filestack.length > 0 || !a.isEmptyObject(e.uploadExtraData),
                v = {
                    id: i,
                    index: b
                };
            e.formdata = g, e.showPreview && (j = a("#" + i + ":not(.file-preview-initial)"), m = j.find(".kv-file-upload"), n = j.find(".kv-file-remove"), a("#" + i).find(".file-thumb-progress").removeClass("hide")), 0 === f || !o || m && m.hasClass("disabled") || e._abort(v) || (u = function(a, b) {
                e.updateStack(a, void 0), e.uploadLog.push(b), e._checkAsyncComplete() && (e.fileBatchCompleted = !0)
            }, l = function() {
                var a = e.uploadCache;
                e.fileBatchCompleted && setTimeout(function() {
                    e.showPreview && (k.set(e.id, a.content, a.config, a.tags, a.append), e.hasInitData && (e._initPreview(), e._initPreviewActions())), e.unlock(), e._clearFileInput(), e._raise("filebatchuploadcomplete", [e.filestack, e._getExtraData()]), e.uploadCount = 0, e.uploadStatus = {}, e.uploadLog = [], e._setProgress(101)
                }, 100)
            }, q = function(c) {
                h = e._getOutData(c), e.fileBatchCompleted = !1, e.showPreview && (j.hasClass("file-preview-success") || (e._setThumbStatus(j, "Loading"), p(j, "file-uploading")), m.attr("disabled", !0), n.attr("disabled", !0)), d || e.lock(), e._raise("filepreupload", [h, i, b]), a.extend(!0, v, h), e._abort(v) && (c.abort(), e._setProgressCancelled())
            }, r = function(c, f, g) {
                var k = e.showPreview && j.attr("id") ? j.attr("id") : i;
                h = e._getOutData(g, c), a.extend(!0, v, h), setTimeout(function() {
                    da(c) || da(c.error) ? (e.showPreview && (e._setThumbStatus(j, "Success"), m.hide(), e._initUploadSuccess(c, j, d)), e._raise("fileuploaded", [h, k, b]), d ? u(b, k) : e.updateStack(b, void 0)) : (e._showUploadError(c.error, v), e._setPreviewError(j, b), d && u(b, k))
                }, 100)
            }, s = function() {
                setTimeout(function() {
                    e.showPreview && (m.removeAttr("disabled"), n.removeAttr("disabled"), j.removeClass("file-uploading"), e._setProgress(101, a("#" + i).find(".file-thumb-progress"))), d ? l() : (e.unlock(!1), e._clearFileInput()), e._initSuccessThumbs()
                }, 100)
            }, t = function(f, g, h) {
                var k = e._parseError(f, h, d ? c[b].name : null);
                setTimeout(function() {
                    d && u(b, i), e.uploadStatus[i] = 100, e._setPreviewError(j, b), a.extend(!0, v, e._getOutData(f)), e._showUploadError(k, v)
                }, 100)
            }, g.append(e.uploadFileAttr, c[b], e.filenames[b]), g.append("file_id", b), e._ajaxSubmit(q, r, s, t, i, b))
        },
        _uploadBatch: function() {
            var f, g, h, i, k, b = this,
                c = b.filestack,
                d = c.length,
                e = {}, j = b.filestack.length > 0 || !a.isEmptyObject(b.uploadExtraData);
            b.formdata = new FormData, 0 !== d && j && !b._abort(e) && (k = function() {
                a.each(c, function(a) {
                    b.updateStack(a, void 0)
                }), b._clearFileInput()
            }, f = function(c) {
                b.lock();
                var d = b._getOutData(c);
                b.showPreview && b._getThumbs().each(function() {
                    var c = a(this),
                        d = c.find(".kv-file-upload"),
                        e = c.find(".kv-file-remove");
                    c.hasClass("file-preview-success") || (b._setThumbStatus(c, "Loading"), p(c, "file-uploading")), d.attr("disabled", !0), e.attr("disabled", !0)
                }), b._raise("filebatchpreupload", [d]), b._abort(d) && (c.abort(), b._setProgressCancelled())
            }, g = function(c, d, e) {
                var f = b._getOutData(e, c),
                    g = b._getThumbs(":not(.file-preview-error)"),
                    h = 0,
                    i = da(c) || da(c.errorkeys) ? [] : c.errorkeys;
                da(c) || da(c.error) ? (b._raise("filebatchuploadsuccess", [f]), k(), b.showPreview ? (g.each(function() {
                    var c = a(this),
                        d = c.find(".kv-file-upload");
                    c.find(".kv-file-upload").hide(), b._setThumbStatus(c, "Success"), c.removeClass("file-uploading"), d.removeAttr("disabled")
                }), b._initUploadSuccess(c)) : b.reset()) : (b.showPreview && (g.each(function() {
                    var c = a(this),
                        d = c.find(".kv-file-remove"),
                        e = c.find(".kv-file-upload");
                    return c.removeClass("file-uploading"), e.removeAttr("disabled"), d.removeAttr("disabled"), 0 === i.length ? void b._setPreviewError(c) : (a.inArray(h, i) !== -1 ? b._setPreviewError(c) : (c.find(".kv-file-upload").hide(), b._setThumbStatus(c, "Success"), b.updateStack(h, void 0)), void h++)
                }), b._initUploadSuccess(c)), b._showUploadError(c.error, f, "filebatchuploaderror"))
            }, i = function() {
                b._setProgress(101), b.unlock(), b._initSuccessThumbs(), b._clearFileInput(), b._raise("filebatchuploadcomplete", [b.filestack, b._getExtraData()])
            }, h = function(c, e, f) {
                var g = b._getOutData(c),
                    h = b._parseError(c, f);
                b._showUploadError(h, g, "filebatchuploaderror"), b.uploadFileCount = d - 1, b.showPreview && (b._getThumbs().each(function() {
                    var c = a(this),
                        d = c.attr("data-fileindex");
                    c.removeClass("file-uploading"), void 0 !== b.filestack[d] && b._setPreviewError(c)
                }), b._getThumbs().removeClass("file-uploading"), b._getThumbs(" .kv-file-upload").removeAttr("disabled"), b._getThumbs(" .kv-file-delete").removeAttr("disabled"))
            }, a.each(c, function(a, d) {
                da(c[a]) || b.formdata.append(b.uploadFileAttr, d, b.filenames[a])
            }), b._ajaxSubmit(f, g, i, h))
        },
        _uploadExtraOnly: function() {
            var c, d, e, f, a = this,
                b = {};
            a.formdata = new FormData, a._abort(b) || (c = function(c) {
                a.lock();
                var d = a._getOutData(c);
                a._raise("filebatchpreupload", [d]), a._setProgress(50), b.data = d, b.xhr = c, a._abort(b) && (c.abort(), a._setProgressCancelled())
            }, d = function(b, c, d) {
                var e = a._getOutData(d, b);
                da(b) || da(b.error) ? (a._raise("filebatchuploadsuccess", [e]), a._clearFileInput(), a._initUploadSuccess(b)) : a._showUploadError(b.error, e, "filebatchuploaderror")
            }, e = function() {
                a._setProgress(101), a.unlock(), a._clearFileInput(), a._raise("filebatchuploadcomplete", [a.filestack, a._getExtraData()])
            }, f = function(c, d, e) {
                var f = a._getOutData(c),
                    g = a._parseError(c, e);
                b.data = f, a._showUploadError(g, f, "filebatchuploaderror")
            }, a._ajaxSubmit(c, d, e, f))
        },
        _initFileActions: function() {
            var b = this;
            b.showPreview && (b._initZoomButton(), b.$preview.find(".kv-file-remove").each(function() {
                var e, h, i, l, c = a(this),
                    d = c.closest(".file-preview-frame"),
                    f = d.attr("id"),
                    g = d.attr("data-fileindex");
                j(c, "click", function() {
                    return l = b._raise("filepreremove", [f, g]), !(l === !1 || !b._validateMinCount()) && (e = d.hasClass("file-preview-error"), ja(d), void d.fadeOut("slow", function() {
                        b.updateStack(g, void 0), b._clearObjects(d), d.remove(), f && e && b.$errorContainer.find('li[data-file-id="' + f + '"]').fadeOut("fast", function() {
                            a(this).remove(), b._errorsExist() || b._resetErrors()
                        }), b._clearFileInput();
                        var c = b.getFileStack(!0),
                            j = k.count(b.id),
                            l = c.length,
                            m = b.showPreview && b.$preview.find(".file-preview-frame").length;
                        0 !== l || 0 !== j || m ? (h = j + l, i = h > 1 ? b._getMsgSelected(h) : c[0] ? b._getFileNames()[0] : "", b._setCaption(i)) : b.reset(), b._raise("fileremoved", [f, g])
                    }))
                })
            }), b.$preview.find(".kv-file-upload").each(function() {
                var c = a(this);
                j(c, "click", function() {
                    var a = c.closest(".file-preview-frame"),
                        d = a.attr("data-fileindex");
                    a.hasClass("file-preview-error") || b._uploadSingle(d, b.filestack, !1)
                })
            }))
        },
        _hideFileIcon: function() {
            this.overwriteInitial && this.$captionContainer.find(".kv-caption-icon").hide()
        },
        _showFileIcon: function() {
            this.$captionContainer.find(".kv-caption-icon").show()
        },
        _getSize: function(a) {
            var b = parseFloat(a);
            if (null === a || isNaN(b)) return "";
            var d, f, g, c = this,
                e = c.fileSizeGetter;
            return "function" == typeof e ? g = e(a) : (d = Math.floor(Math.log(b) / Math.log(1024)), f = ["B", "KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB"], g = 1 * (b / Math.pow(1024, d)).toFixed(2) + " " + f[d]), c._getLayoutTemplate("size").replace("{sizeText}", g)
        },
        _generatePreviewTemplate: function(a, b, c, d, e, f, g, h, i, j) {
            var m, n, k = this,
                l = k._getPreviewTemplate(a),
                o = h || "",
                p = fa(a, k.previewSettings, ba[a]),
                q = k.slug(c),
                r = i || k._renderFileFooter(q, g, p.width, f);
            return j = j || e.slice(e.lastIndexOf("-") + 1), l = k._parseFilePreviewIcon(l, c), "text" === a || "html" === a ? (n = "text" === a ? ha(b) : b, m = l.replace(/\{previewId}/g, e).replace(/\{caption}/g, q).replace(/\{width}/g, p.width).replace(/\{height}/g, p.height).replace(/\{frameClass}/g, o).replace(/\{cat}/g, d).replace(/\{footer}/g, r).replace(/\{fileindex}/g, j).replace(/\{data}/g, n).replace(/\{template}/g, a)) : m = l.replace(/\{previewId}/g, e).replace(/\{caption}/g, q).replace(/\{frameClass}/g, o).replace(/\{type}/g, d).replace(/\{fileindex}/g, j).replace(/\{width}/g, p.width).replace(/\{height}/g, p.height).replace(/\{footer}/g, r).replace(/\{data}/g, b).replace(/\{template}/g, a), m
        },
        _previewDefault: function(b, c, d) {
            var e = this,
                f = e.$preview,
                h = f.find(".file-live-thumbs");
            if (e.showPreview) {
                var k, i = b ? b.name : "",
                    j = b ? b.type : "",
                    l = d === !0 && !e.isUploadable,
                    m = g.createObjectURL(b);
                e._clearDefaultPreview(), k = e._generatePreviewTemplate("other", m, i, j, c, l, b.size), h.length || (h = a(document.createElement("div")).addClass("file-live-thumbs").appendTo(f)), h.append("\n" + k), d === !0 && e.isUploadable && e._setThumbStatus(a("#" + c), "Error")
            }
        },
        _previewFile: function(b, c, d, e, f) {
            if (this.showPreview) {
                var q, g = this,
                    h = g._parseFileType(c),
                    i = c ? c.name : "",
                    j = g.slug(i),
                    k = g.allowedPreviewTypes,
                    l = g.allowedPreviewMimeTypes,
                    m = g.$preview,
                    n = k && k.indexOf(h) >= 0,
                    o = m.find(".file-live-thumbs"),
                    p = "text" === h || "html" === h || "image" === h ? d.target.result : f,
                    r = l && l.indexOf(c.type) !== -1;
                o.length || (o = a(document.createElement("div")).addClass("file-live-thumbs").appendTo(m)), "html" === h && g.purifyHtml && window.DOMPurify && (p = window.DOMPurify.sanitize(p)), n || r ? (q = g._generatePreviewTemplate(h, p, i, c.type, e, !1, c.size), g._clearDefaultPreview(), o.append("\n" + q), g._validateImage(b, e, j, c.type)) : g._previewDefault(c, e), g._initSortable()
            }
        },
        _slugDefault: function(a) {
            return da(a) ? "" : String(a).replace(/[\-\[\]\/\{}:;#%=\(\)\*\+\?\\\^\$\|<>&"']/g, "_")
        },
        _readFiles: function(b) {
            this.reader = new FileReader;
            var q, c = this,
                d = c.$element,
                e = c.$preview,
                f = c.reader,
                i = c.$previewContainer,
                j = c.$previewStatus,
                k = c.msgLoading,
                l = c.msgProgress,
                m = c.previewInitId,
                n = b.length,
                o = c.fileTypeSettings,
                p = c.filestack.length,
                r = c.maxFilePreviewSize && parseFloat(c.maxFilePreviewSize),
                s = e.length && (!r || isNaN(r)),
                t = function(d, e, f, g) {
                    var h = a.extend(!0, {}, c._getOutData({}, {}, b), {
                        id: f,
                        index: g
                    }),
                        i = {
                            id: f,
                            index: g,
                            file: e,
                            files: b
                        };
                    return c._previewDefault(e, f, !0), c.isUploadable && c.addToStack(void 0), setTimeout(function() {
                        q(g + 1)
                    }, 100), c._initFileActions(), c.removeFromPreviewOnError && a("#" + f).remove(), c.isUploadable ? c._showUploadError(d, h) : c._showError(d, i)
                };
            c.loadedImages = [], c.totalImagesCount = 0, a.each(b, function(a, b) {
                var d = c.fileTypeSettings.image || ca.image;
                d && d(b.type) && c.totalImagesCount++
            }), q = function(a) {
                if (da(d.attr("multiple")) && (n = 1), a >= n) return c.isUploadable && c.filestack.length > 0 ? c._raise("filebatchselected", [c.getFileStack()]) : c._raise("filebatchselected", [b]), i.removeClass("file-thumb-loading"), void j.html("");
                var w, x, B, F, G, H, I, u = p + a,
                    v = m + "-" + u,
                    y = b[a],
                    z = c.slug(y.name),
                    A = (y.size || 0) / 1e3,
                    C = "",
                    D = g.createObjectURL(y),
                    E = 0,
                    J = c.allowedFileTypes,
                    K = da(J) ? "" : J.join(", "),
                    L = c.allowedFileExtensions,
                    M = da(L) ? "" : L.join(", ");
                if (da(L) || (C = new RegExp("\\.(" + L.join("|") + ")$", "i")), A = A.toFixed(2), c.maxFileSize > 0 && A > c.maxFileSize) return G = c.msgSizeTooLarge.replace("{name}", z).replace("{size}", A).replace("{maxSize}", c.maxFileSize), void(c.isError = t(G, y, v, a));
                if (!da(J) && ea(J)) {
                    for (F = 0; F < J.length; F += 1) H = J[F], B = o[H], I = void 0 !== B && B(y.type, z), E += da(I) ? 0 : I.length;
                    if (0 === E) return G = c.msgInvalidFileType.replace("{name}", z).replace("{types}", K), void(c.isError = t(G, y, v, a))
                }
                return 0 !== E || da(L) || !ea(L) || da(C) || (I = h(z, C), E += da(I) ? 0 : I.length, 0 !== E) ? c.showPreview ? !s && A > r ? (c.addToStack(y), i.addClass("file-thumb-loading"), c._previewDefault(y, v), c._initFileActions(), c._updateFileDetails(n), void q(a + 1)) : (e.length && void 0 !== FileReader ? (j.html(k.replace("{index}", a + 1).replace("{files}", n)), i.addClass("file-thumb-loading"), f.onerror = function(a) {
                    c._errorHandler(a, z)
                }, f.onload = function(b) {
                    c._previewFile(a, y, b, v, D), c._initFileActions()
                }, f.onloadend = function() {
                    G = l.replace("{index}", a + 1).replace("{files}", n).replace("{percent}", 50).replace("{name}", z), setTimeout(function() {
                        j.html(G), c._updateFileDetails(n), q(a + 1)
                    }, 100), c._raise("fileloaded", [y, v, a, f])
                }, f.onprogress = function(b) {
                    if (b.lengthComputable) {
                        var c = b.loaded / b.total * 100,
                            d = Math.ceil(c);
                        G = l.replace("{index}", a + 1).replace("{files}", n).replace("{percent}", d).replace("{name}", z), setTimeout(function() {
                            j.html(G)
                        }, 100)
                    }
                }, w = fa("text", o, ca.text), x = fa("image", o, ca.image), w(y.type, z) ? f.readAsText(y, c.textEncoding) : x(y.type, z) ? f.readAsDataURL(y) : f.readAsArrayBuffer(y)) : (c._previewDefault(y, v), setTimeout(function() {
                    q(a + 1), c._updateFileDetails(n)
                }, 100), c._raise("fileloaded", [y, v, a, f])), void c.addToStack(y)) : (c.addToStack(y), setTimeout(function() {
                    q(a + 1)
                }, 100), void c._raise("fileloaded", [y, v, a, f])) : (G = c.msgInvalidFileExtension.replace("{name}", z).replace("{extensions}", M), void(c.isError = t(G, y, v, a)))
            }, q(0), c._updateFileDetails(n, !1)
        },
        _updateFileDetails: function(a) {
            var b = this,
                c = b.$element,
                d = b.getFileStack(),
                e = i(9) && ka(c.val()) || c[0].files[0] && c[0].files[0].name || d.length && d[0].name || "",
                f = b.slug(e),
                g = b.isUploadable ? d.length : a,
                h = k.count(b.id) + g,
                j = g > 1 ? b._getMsgSelected(h) : f;
            b.isError ? (b.$previewContainer.removeClass("file-thumb-loading"), b.$previewStatus.html(""), b.$captionContainer.find(".kv-caption-icon").hide()) : b._showFileIcon(), b._setCaption(j, b.isError), b.$container.removeClass("file-input-new file-input-ajax-new"), 1 === arguments.length && b._raise("fileselect", [a, f]), k.count(b.id) && b._initPreviewActions()
        },
        _setThumbStatus: function(a, b) {
            var c = this;
            if (c.showPreview) {
                var d = "indicator" + b,
                    e = d + "Title",
                    f = "file-preview-" + b.toLowerCase(),
                    g = a.find(".file-upload-indicator"),
                    h = c.fileActionSettings;
                a.removeClass("file-preview-success file-preview-error file-preview-loading"), "Error" === b && a.find(".kv-file-upload").attr("disabled", !0), "Success" === b && (a.find(".file-drag-handle").remove(), g.css("margin-left", 0)), g.html(h[d]), g.attr("title", h[e]), a.addClass(f)
            }
        },
        _setProgressCancelled: function() {
            var a = this;
            a._setProgress(101, a.$progress, a.msgCancelled)
        },
        _setProgress: function(a, b, c) {
            var d = this,
                e = Math.min(a, 100),
                f = e < 100 ? d.progressTemplate : c ? d.progressErrorTemplate : a <= 100 ? d.progressTemplate : d.progressCompleteTemplate,
                g = d.progressUploadThreshold;
            if (b = b || d.$progress, !da(f)) {
                if (g && e > g && a <= 100) {
                    var h = f.replace("{percent}", g).replace("{percent}", g).replace("{percent}%", d.msgUploadThreshold);
                    b.html(h)
                } else b.html(f.replace(/\{percent}/g, e));
                c && b.find('[role="progressbar"]').html(c)
            }
        },
        _setFileDropZoneTitle: function() {
            var d, a = this,
                b = a.$container.find(".file-drop-zone"),
                c = a.dropZoneTitle;
            a.isClickable && (d = da(a.$element.attr("multiple")) ? a.fileSingle : a.filePlural, c += a.dropZoneClickTitle.replace("{files}", d)), b.find("." + a.dropZoneTitleClass).remove(), a.isUploadable && a.showPreview && 0 !== b.length && !(a.getFileStack().length > 0) && a.dropZoneEnabled && (0 === b.find(".file-preview-frame").length && da(a.defaultPreviewContent) && b.prepend('<div class="' + a.dropZoneTitleClass + '">' + c + "</div>"), a.$container.removeClass("file-input-new"), p(a.$container, "file-input-ajax-new"))
        },
        _setAsyncUploadStatus: function(b, c, d) {
            var e = this,
                f = 0;
            e._setProgress(c, a("#" + b).find(".file-thumb-progress")), e.uploadStatus[b] = c, a.each(e.uploadStatus, function(a, b) {
                f += b
            }), e._setProgress(Math.floor(f / d))
        },
        _validateMinCount: function() {
            var a = this,
                b = a.isUploadable ? a.getFileStack().length : a.$element.get(0).files.length;
            return !(a.validateInitialCount && a.minFileCount > 0 && a._getFileCount(b - 1) < a.minFileCount) || (a._noFilesError({}), !1)
        },
        _getFileCount: function(a) {
            var b = this,
                c = 0;
            return b.validateInitialCount && !b.overwriteInitial && (c = k.count(b.id), a += c), a
        },
        _getFileName: function(a) {
            return a && a.name ? this.slug(a.name) : void 0
        },
        _getFileNames: function(a) {
            var b = this;
            return b.filenames.filter(function(b) {
                return a ? void 0 !== b : void 0 !== b && null !== b
            })
        },
        _setPreviewError: function(a, b, c) {
            var d = this;
            void 0 !== b && d.updateStack(b, c), d.removeFromPreviewOnError ? a.remove() : d._setThumbStatus(a, "Error")
        },
        _checkDimensions: function(a, b, c, d, e, f, g) {
            var i, j, m, n, h = this,
                k = "Small" === b ? "min" : "max",
                l = h[k + "Image" + f];
            !da(l) && c.length && (m = c[0], j = "Width" === f ? m.naturalWidth || m.width : m.naturalHeight || m.height, n = "Small" === b ? j >= l : j <= l, n || (i = h["msgImage" + f + b].replace("{name}", e).replace("{size}", l), h._showUploadError(i, g), h._setPreviewError(d, a, null)))
        },
        _validateImage: function(a, b, c, d) {
            var h, i, k, e = this,
                f = e.$preview,
                l = f.find("#" + b),
                m = l.find("img");
            c = c || "Untitled", m.length && j(m, "load", function() {
                i = l.width(), k = f.width(), i > k && (m.css("width", "100%"), l.css("width", "97%")), h = {
                    ind: a,
                    id: b
                }, e._checkDimensions(a, "Small", m, l, c, "Width", h), e._checkDimensions(a, "Small", m, l, c, "Height", h), e.resizeImage || (e._checkDimensions(a, "Large", m, l, c, "Width", h), e._checkDimensions(a, "Large", m, l, c, "Height", h)), e._raise("fileimageloaded", [b]), e.loadedImages.push({
                    ind: a,
                    img: m,
                    thumb: l,
                    pid: b,
                    typ: d
                }), e._validateAllImages(), g.revokeObjectURL(m.attr("src"))
            })
        },
        _validateAllImages: function() {
            var b, c, d, e, f, g, i, a = this,
                h = {};
            if (a.loadedImages.length === a.totalImagesCount && (a._raise("fileimagesloaded"), a.resizeImage)) {
                for (i = a.isUploadable ? a._showUploadError : a._showError, b = 0; b < a.loadedImages.length; b++) c = a.loadedImages[b], d = c.img, e = c.thumb, f = c.pid, g = c.ind, h = {
                    id: f,
                    index: g
                }, a._getResizedImage(d[0], c.typ, f, g) || (i(a.msgImageResizeError, h, "fileimageresizeerror"), a._setPreviewError(e, g));
                a._raise("fileimagesresized")
            }
        },
        _getResizedImage: function(a, b, c, d) {
            var l, m, e = this,
                f = a.naturalWidth,
                g = a.naturalHeight,
                h = 1,
                i = e.maxImageWidth || f,
                j = e.maxImageHeight || g,
                k = f && g,
                n = e.imageCanvas,
                o = e.imageCanvasContext;
            if (!k) return !1;
            if (f === i && g === j) return !0;
            b = b || e.resizeDefaultImageType, l = f > i, m = g > j, h = "width" === e.resizePreference ? l ? i / f : m ? j / g : 1 : m ? j / g : l ? i / f : 1, e._resetCanvas(), f *= h, g *= h, n.width = f, n.height = g;
            try {
                return o.drawImage(a, 0, 0, f, g), n.toBlob(function(a) {
                    e._raise("fileimageresized", [c, d]), e.filestack[d] = a
                }, b, e.resizeQuality), !0
            } catch (a) {
                return !1
            }
        },
        _initBrowse: function(a) {
            var b = this;
            b.showBrowse ? (b.$btnFile = a.find(".btn-file"), b.$btnFile.append(b.$element)) : b.$element.hide()
        },
        _initCaption: function() {
            var a = this,
                b = a.initialCaption || "";
            return a.overwriteInitial || da(b) ? (a.$caption.html(""), !1) : (a._setCaption(b), !0)
        },
        _setCaption: function(b, c) {
            var e, f, g, h, d = this,
                i = d.getFileStack();
            if (d.$caption.length) {
                if (c) e = a("<div>" + d.msgValidationError + "</div>").text(), g = i.length, h = g ? 1 === g && i[0] ? d._getFileNames()[0] : d._getMsgSelected(g) : d._getMsgSelected(d.msgNo), f = '<span class="' + d.msgValidationErrorClass + '">' + d.msgValidationErrorIcon + (da(b) ? h : b) + "</span>";
                else {
                    if (da(b)) return;
                    e = a("<div>" + b + "</div>").text(), f = d._getLayoutTemplate("fileIcon") + e
                }
                d.$caption.html(f), d.$caption.attr("title", e), d.$captionContainer.find(".file-caption-ellipsis").attr("title", e)
            }
        },
        _createContainer: function() {
            var b = this,
                c = a(document.createElement("div")).attr({
                    class: "file-input file-input-new"
                }).html(b._renderMain());
            return b.$element.before(c), b._initBrowse(c), b.theme && c.addClass("theme-" + b.theme), c
        },
        _refreshContainer: function() {
            var a = this,
                b = a.$container;
            b.before(a.$element), b.html(a._renderMain()), a._initBrowse(b)
        },
        _renderMain: function() {
            var a = this,
                b = a.isUploadable && a.dropZoneEnabled ? " file-drop-zone" : "file-drop-disabled",
                c = a.showClose ? a._getLayoutTemplate("close") : "",
                d = a.showPreview ? a._getLayoutTemplate("preview").replace(/\{class}/g, a.previewClass).replace(/\{dropClass}/g, b) : "",
                e = a.isDisabled ? a.captionClass + " file-caption-disabled" : a.captionClass,
                f = a.captionTemplate.replace(/\{class}/g, e + " kv-fileinput-caption");
            return a.mainTemplate.replace(/\{class}/g, a.mainClass + (!a.showBrowse && a.showCaption ? " no-browse" : "")).replace(/\{preview}/g, d).replace(/\{close}/g, c).replace(/\{caption}/g, f).replace(/\{upload}/g, a._renderButton("upload")).replace(/\{remove}/g, a._renderButton("remove")).replace(/\{cancel}/g, a._renderButton("cancel")).replace(/\{browse}/g, a._renderButton("browse"))
        },
        _renderButton: function(a) {
            var b = this,
                c = b._getLayoutTemplate("btnDefault"),
                d = b[a + "Class"],
                e = b[a + "Title"],
                f = b[a + "Icon"],
                g = b[a + "Label"],
                h = b.isDisabled ? " disabled" : "",
                i = "button";
            switch (a) {
                case "remove":
                    if (!b.showRemove) return "";
                    break;
                case "cancel":
                    if (!b.showCancel) return "";
                    d += " hide";
                    break;
                case "upload":
                    if (!b.showUpload) return "";
                    b.isUploadable && !b.isDisabled ? c = b._getLayoutTemplate("btnLink").replace("{href}", b.uploadUrl) : i = "submit";
                    break;
                case "browse":
                    if (!b.showBrowse) return "";
                    c = b._getLayoutTemplate("btnBrowse");
                    break;
                default:
                    return ""
            }
            return d += "browse" === a ? " btn-file" : " fileinput-" + a + " fileinput-" + a + "-button", da(g) || (g = ' <span class="' + b.buttonLabelClass + '">' + g + "</span>"), c.replace("{type}", i).replace("{css}", d).replace("{title}", e).replace("{status}", h).replace("{icon}", f).replace("{label}", g)
        },
        _renderThumbProgress: function() {
            return '<div class="file-thumb-progress hide">' + this.progressTemplate.replace(/\{percent}/g, "0") + "</div>"
        },
        _renderFileFooter: function(a, b, c, d) {
            var k, e = this,
                f = e.fileActionSettings,
                g = f.showRemove,
                h = f.showDrag,
                i = f.showUpload,
                j = f.showZoom,
                l = e._getLayoutTemplate("footer"),
                m = d ? f.indicatorError : f.indicatorNew,
                n = d ? f.indicatorErrorTitle : f.indicatorNewTitle;
            return b = e._getSize(b), k = e.isUploadable ? l.replace(/\{actions}/g, e._renderFileActions(i, g, j, h, !1, !1, !1)).replace(/\{caption}/g, a).replace(/\{size}/g, b).replace(/\{width}/g, c).replace(/\{progress}/g, e._renderThumbProgress()).replace(/\{indicator}/g, m).replace(/\{indicatorTitle}/g, n) : l.replace(/\{actions}/g, e._renderFileActions(!1, !1, j, h, !1, !1, !1)).replace(/\{caption}/g, a).replace(/\{size}/g, b).replace(/\{width}/g, c).replace(/\{progress}/g, "").replace(/\{indicator}/g, m).replace(/\{indicatorTitle}/g, n), k = ia(k, e.previewThumbTags)
        },
        _renderFileActions: function(a, b, c, d, e, f, g, h) {
            if (!(a || b || c || d)) return "";
            var p, i = this,
                j = f === !1 ? "" : ' data-url="' + f + '"',
                k = g === !1 ? "" : ' data-key="' + g + '"',
                l = "",
                m = "",
                n = "",
                o = "",
                q = i._getLayoutTemplate("actions"),
                r = i.fileActionSettings,
                s = i.otherActionButtons.replace(/\{dataKey}/g, k),
                t = e ? r.removeClass + " disabled" : r.removeClass;
            return b && (l = i._getLayoutTemplate("actionDelete").replace(/\{removeClass}/g, t).replace(/\{removeIcon}/g, r.removeIcon).replace(/\{removeTitle}/g, r.removeTitle).replace(/\{dataUrl}/g, j).replace(/\{dataKey}/g, k)), a && (m = i._getLayoutTemplate("actionUpload").replace(/\{uploadClass}/g, r.uploadClass).replace(/\{uploadIcon}/g, r.uploadIcon).replace(/\{uploadTitle}/g, r.uploadTitle)), c && (n = i._getLayoutTemplate("actionZoom").replace(/\{zoomClass}/g, r.zoomClass).replace(/\{zoomIcon}/g, r.zoomIcon).replace(/\{zoomTitle}/g, r.zoomTitle)), d && h && (p = "drag-handle-init " + r.dragClass, o = i._getLayoutTemplate("actionDrag").replace(/\{dragClass}/g, p).replace(/\{dragTitle}/g, r.dragTitle).replace(/\{dragIcon}/g, r.dragIcon)), q.replace(/\{delete}/g, l).replace(/\{upload}/g, m).replace(/\{zoom}/g, n).replace(/\{drag}/g, o).replace(/\{other}/g, s)
        },
        _browse: function(a) {
            var b = this;
            b._raise("filebrowse"), a && a.isDefaultPrevented() || (b.isError && !b.isUploadable && b.clear(), b.$captionContainer.focus())
        },
        _change: function(b) {
            var c = this,
                d = c.$element;
            if (!c.isUploadable && da(d.val()) && c.fileInputCleared) return void(c.fileInputCleared = !1);
            c.fileInputCleared = !1;
            var e, f, g, l, m, n, h = arguments.length > 1,
                i = c.isUploadable,
                j = 0,
                o = h ? b.originalEvent.dataTransfer.files : d.get(0).files,
                p = c.filestack.length,
                q = da(d.attr("multiple")),
                r = q && p > 0,
                s = 0,
                t = function(b, d, e, f) {
                    var g = a.extend(!0, {}, c._getOutData({}, {}, o), {
                        id: e,
                        index: f
                    }),
                        h = {
                            id: e,
                            index: f,
                            file: d,
                            files: o
                        };
                    return c.isUploadable ? c._showUploadError(b, g) : c._showError(b, h)
                };
            if (c.reader = null, c._resetUpload(), c._hideFileIcon(), c.isUploadable && c.$container.find(".file-drop-zone ." + c.dropZoneTitleClass).remove(), h)
                for (e = []; o[j];) l = o[j], l.type || l.size % 4096 !== 0 ? e.push(l) : s++, j++;
            else e = void 0 === b.target.files ? b.target && b.target.value ? [{
                name: b.target.value.replace(/^.+\\/, "")
            }] : [] : b.target.files; if (da(e) || 0 === e.length) return i || c.clear(), c._showFolderError(s), void c._raise("fileselectnone");
            if (c._resetErrors(), n = e.length, g = c._getFileCount(c.isUploadable ? c.getFileStack().length + n : n), c.maxFileCount > 0 && g > c.maxFileCount) {
                if (!c.autoReplace || n > c.maxFileCount) return m = c.autoReplace && n > c.maxFileCount ? n : g, f = c.msgFilesTooMany.replace("{m}", c.maxFileCount).replace("{n}", m), c.isError = t(f, null, null, null), c.$captionContainer.find(".kv-caption-icon").hide(), c._setCaption("", !0), void c.$container.removeClass("file-input-new file-input-ajax-new");
                g > c.maxFileCount && c._resetPreviewThumbs(i)
            } else !i || r ? (c._resetPreviewThumbs(!1), r && c.clearStack()) : !i || 0 !== p || k.count(c.id) && !c.overwriteInitial || c._resetPreviewThumbs(!0);
            c.isPreviewable ? c._readFiles(e) : c._updateFileDetails(1), c._showFolderError(s)
        },
        _abort: function(b) {
            var d, c = this;
            return !(!c.ajaxAborted || "object" != typeof c.ajaxAborted || void 0 === c.ajaxAborted.message) && (d = a.extend(!0, {}, c._getOutData(), b), d.abortData = c.ajaxAborted.data || {}, d.abortMessage = c.ajaxAborted.message, c.cancel(), c._setProgress(101, c.$progress, c.msgCancelled), c._showUploadError(c.ajaxAborted.message, d, "filecustomerror"), !0)
        },
        _resetFileStack: function() {
            var b = this,
                c = 0,
                d = [],
                e = [];
            b._getThumbs().each(function() {
                var f = a(this),
                    g = f.attr("data-fileindex"),
                    h = b.filestack[g];
                g !== -1 && (void 0 !== h ? (d[c] = h, e[c] = b._getFileName(h), f.attr({
                    id: b.previewInitId + "-" + c,
                    "data-fileindex": c
                }), c++) : f.attr({
                    id: "uploaded-" + ga(),
                    "data-fileindex": "-1"
                }))
            }), b.filestack = d, b.filenames = e
        },
        clearStack: function() {
            var a = this;
            return a.filestack = [], a.filenames = [], a.$element
        },
        updateStack: function(a, b) {
            var c = this;
            return c.filestack[a] = b, c.filenames[a] = c._getFileName(b), c.$element
        },
        addToStack: function(a) {
            var b = this;
            return b.filestack.push(a), b.filenames.push(b._getFileName(a)), b.$element
        },
        getFileStack: function(a) {
            var b = this;
            return b.filestack.filter(function(b) {
                return a ? void 0 !== b : void 0 !== b && null !== b
            })
        },
        getFilesCount: function() {
            var a = this,
                b = a.isUploadable ? a.getFileStack().length : a.$element.get(0).files.length;
            return a._getFileCount(b)
        },
        lock: function() {
            var a = this;
            return a._resetErrors(), a.disable(), a.showRemove && p(a.$container.find(".fileinput-remove"), "hide"), a.showCancel && a.$container.find(".fileinput-cancel").removeClass("hide"), a._raise("filelock", [a.filestack, a._getExtraData()]), a.$element
        },
        unlock: function(a) {
            var b = this;
            return void 0 === a && (a = !0), b.enable(), b.showCancel && p(b.$container.find(".fileinput-cancel"), "hide"), b.showRemove && b.$container.find(".fileinput-remove").removeClass("hide"), a && b._resetFileStack(), b._raise("fileunlock", [b.filestack, b._getExtraData()]), b.$element
        },
        cancel: function() {
            var e, b = this,
                c = b.ajaxRequests,
                d = c.length;
            if (d > 0)
                for (e = 0; e < d; e += 1) b.cancelling = !0, c[e].abort();
            return b._setProgressCancelled(), b._getThumbs().each(function() {
                var c = a(this),
                    d = c.attr("data-fileindex");
                c.removeClass("file-uploading"), void 0 !== b.filestack[d] && (c.find(".kv-file-upload").removeClass("disabled").removeAttr("disabled"), c.find(".kv-file-remove").removeClass("disabled").removeAttr("disabled")), b.unlock()
            }), b.$element
        },
        clear: function() {
            var c, b = this;
            return b.$btnUpload.removeAttr("disabled"), b._getThumbs().find("video,audio,img").each(function() {
                ja(a(this))
            }), b._resetUpload(), b.clearStack(), b._clearFileInput(), b._resetErrors(!0), b._raise("fileclear"), b._hasInitialPreview() ? (b._showFileIcon(), b._resetPreview(), b._initPreviewActions(), b.$container.removeClass("file-input-new")) : (b._getThumbs().each(function() {
                b._clearObjects(a(this))
            }), b.isUploadable && (k.data[b.id] = {}), b.$preview.html(""), c = !b.overwriteInitial && b.initialCaption.length > 0 ? b.initialCaption : "", b.$caption.html(c), b.$caption.attr("title", ""), p(b.$container, "file-input-new"), b._validateDefaultPreview()), 0 === b.$container.find(".file-preview-frame").length && (b._initCaption() || b.$captionContainer.find(".kv-caption-icon").hide()), b._hideFileIcon(), b._raise("filecleared"), b.$captionContainer.focus(), b._setFileDropZoneTitle(), b.$element
        },
        reset: function() {
            var a = this;
            return a._resetPreview(), a.$container.find(".fileinput-filename").text(""), a._raise("filereset"), p(a.$container, "file-input-new"), (a.$preview.find(".file-preview-frame").length || a.isUploadable && a.dropZoneEnabled) && a.$container.removeClass("file-input-new"),
            a._setFileDropZoneTitle(), a.clearStack(), a.formdata = {}, a.$element
        },
        disable: function() {
            var a = this;
            return a.isDisabled = !0, a._raise("filedisabled"), a.$element.attr("disabled", "disabled"), a.$container.find(".kv-fileinput-caption").addClass("file-caption-disabled"), a.$container.find(".btn-file, .fileinput-remove, .fileinput-upload, .file-preview-frame button").attr("disabled", !0), a._initDragDrop(), a.$element
        },
        enable: function() {
            var a = this;
            return a.isDisabled = !1, a._raise("fileenabled"), a.$element.removeAttr("disabled"), a.$container.find(".kv-fileinput-caption").removeClass("file-caption-disabled"), a.$container.find(".btn-file, .fileinput-remove, .fileinput-upload, .file-preview-frame button").removeAttr("disabled"), a._initDragDrop(), a.$element
        },
        upload: function() {
            var e, f, g, b = this,
                c = b.getFileStack().length,
                d = {}, h = !a.isEmptyObject(b._getExtraData());
            if (b.minFileCount > 0 && b._getFileCount(c) < b.minFileCount) return void b._noFilesError(d);
            if (b.isUploadable && !b.isDisabled && (0 !== c || h)) {
                if (b._resetUpload(), b.$progress.removeClass("hide"), b.uploadCount = 0, b.uploadStatus = {}, b.uploadLog = [], b.lock(), b._setProgress(2), 0 === c && h) return void b._uploadExtraOnly();
                if (g = b.filestack.length, b.hasInitData = !1, !b.uploadAsync) return b._uploadBatch(), b.$element;
                for (f = b._getOutData(), b._raise("filebatchpreupload", [f]), b.fileBatchCompleted = !1, b.uploadCache = {
                    content: [],
                    config: [],
                    tags: [],
                    append: !0
                }, b.uploadAsyncCount = b.getFileStack().length, e = 0; e < g; e++) b.uploadCache.content[e] = null, b.uploadCache.config[e] = null, b.uploadCache.tags[e] = null;
                for (e = 0; e < g; e++) void 0 !== b.filestack[e] && b._uploadSingle(e, b.filestack, !0)
            }
        },
        destroy: function() {
            var a = this,
                c = a.$container;
            return c.find(".file-drop-zone").off(), a.$element.insertBefore(c).off(b).removeData(), c.off().remove(), a.$element
        },
        refresh: function(b) {
            var c = this,
                d = c.$element;
            return b = b ? a.extend(!0, {}, c.options, b) : c.options, c.destroy(), d.fileinput(b), d.val() && d.trigger("change.fileinput"), d
        }
    }, a.fn.fileinput = function(b) {
        if (m() || i(9)) {
            var c = Array.apply(null, arguments),
                d = [];
            switch (c.shift(), this.each(function() {
                var l, e = a(this),
                    f = e.data("fileinput"),
                    g = "object" == typeof b && b,
                    h = g.theme || e.data("theme"),
                    i = {}, j = {}, k = g.language || e.data("language") || "en";
                f || (h && (j = a.fn.fileinputThemes[h] || {}), "en" === k || da(a.fn.fileinputLocales[k]) || (i = a.fn.fileinputLocales[k] || {}), l = a.extend(!0, {}, a.fn.fileinput.defaults, j, a.fn.fileinputLocales.en, i, g, e.data()), f = new oa(this, l), e.data("fileinput", f)), "string" == typeof b && d.push(f[b].apply(f, c))
            }), d.length) {
                case 0:
                    return this;
                case 1:
                    return d[0];
                default:
                    return d
            }
        }
    }, a.fn.fileinput.defaults = {
        language: "en",
        showCaption: !0,
        showBrowse: !0,
        showPreview: !0,
        showRemove: !0,
        showUpload: !0,
        showCancel: !0,
        showClose: !0,
        showUploadedThumbs: !0,
        browseOnZoneClick: !1,
        autoReplace: !1,
        previewClass: "",
        captionClass: "",
        mainClass: "file-caption-main",
        mainTemplate: null,
        purifyHtml: !0,
        fileSizeGetter: null,
        initialCaption: "",
        initialPreview: [],
        initialPreviewDelimiter: "*$$*",
        initialPreviewAsData: !1,
        initialPreviewFileType: "image",
        initialPreviewConfig: [],
        initialPreviewThumbTags: [],
        previewThumbTags: {},
        initialPreviewShowDelete: !0,
        removeFromPreviewOnError: !1,
        deleteUrl: "",
        deleteExtraData: {},
        overwriteInitial: !0,
        layoutTemplates: Y,
        previewTemplates: Z,
        previewZoomSettings: $,
        previewZoomButtonIcons: {
            prev: '<i class="glyphicon glyphicon-triangle-left"></i>',
            next: '<i class="glyphicon glyphicon-triangle-right"></i>',
            toggleheader: '<i class="glyphicon glyphicon-resize-vertical"></i>',
            fullscreen: '<i class="glyphicon glyphicon-fullscreen"></i>',
            borderless: '<i class="glyphicon glyphicon-resize-full"></i>',
            close: '<i class="glyphicon glyphicon-remove"></i>'
        },
        previewZoomButtonClasses: {
            prev: "btn btn-navigate",
            next: "btn btn-navigate",
            toggleheader: "btn btn-default btn-header-toggle",
            fullscreen: "btn btn-default",
            borderless: "btn btn-default",
            close: "btn btn-default"
        },
        allowedPreviewTypes: _,
        allowedPreviewMimeTypes: null,
        allowedFileTypes: null,
        allowedFileExtensions: null,
        defaultPreviewContent: null,
        customLayoutTags: {},
        customPreviewTags: {},
        previewSettings: ba,
        fileTypeSettings: ca,
        previewFileIcon: '<i class="glyphicon glyphicon-file"></i>',
        previewFileIconClass: "file-other-icon",
        previewFileIconSettings: {},
        previewFileExtSettings: {},
        buttonLabelClass: "hidden-xs",
        browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>&nbsp;',
        browseClass: "btn btn-primary",
        removeIcon: '<i class="glyphicon glyphicon-trash"></i>',
        removeClass: "btn btn-default",
        cancelIcon: '<i class="glyphicon glyphicon-ban-circle"></i>',
        cancelClass: "btn btn-default",
        uploadIcon: '<i class="glyphicon glyphicon-upload"></i>',
        uploadClass: "btn btn-default",
        uploadUrl: null,
        uploadAsync: !0,
        uploadExtraData: {},
        zoomModalHeight: 480,
        minImageWidth: null,
        minImageHeight: null,
        maxImageWidth: null,
        maxImageHeight: null,
        resizeImage: !1,
        resizePreference: "width",
        resizeQuality: .92,
        resizeDefaultImageType: "image/jpeg",
        maxFileSize: 0,
        maxFilePreviewSize: 25600,
        minFileCount: 0,
        maxFileCount: 0,
        validateInitialCount: !1,
        msgValidationErrorClass: "text-danger",
        msgValidationErrorIcon: '<i class="glyphicon glyphicon-exclamation-sign"></i> ',
        msgErrorClass: "file-error-message",
        progressThumbClass: "progress-bar progress-bar-success progress-bar-striped active",
        progressClass: "progress-bar progress-bar-success progress-bar-striped active",
        progressCompleteClass: "progress-bar progress-bar-success",
        progressErrorClass: "progress-bar progress-bar-danger",
        progressUploadThreshold: 99,
        previewFileType: "image",
        elCaptionContainer: null,
        elCaptionText: null,
        elPreviewContainer: null,
        elPreviewImage: null,
        elPreviewStatus: null,
        elErrorContainer: null,
        errorCloseButton: '<span class="close kv-error-close">&times;</span>',
        slugCallback: null,
        dropZoneEnabled: !0,
        dropZoneTitleClass: "file-drop-zone-title",
        fileActionSettings: {},
        otherActionButtons: "",
        textEncoding: "UTF-8",
        ajaxSettings: {},
        ajaxDeleteSettings: {},
        showAjaxErrorDetails: !0
    }, a.fn.fileinputLocales.en = {
        fileSingle: "file",
        filePlural: "files",
        browseLabel: "选择图片",
        removeLabel: "删除",
        removeTitle: "删除已选择图片",
        cancelLabel: "取消",
        cancelTitle: "中止正在进行的上传",
        uploadLabel: "上传",
        uploadTitle: "点击上传图片",
        msgNo: "No",
        msgNoFilesSelected: "没有选择图片",
        msgCancelled: "取消",
        msgZoomModalHeading: "详细预览",
        msgSizeTooLarge: 'File "{name}" (<b>{size} KB</b>) exceeds maximum allowed upload size of <b>{maxSize} KB</b>.',
        msgFilesTooLess: "You must select at least <b>{n}</b> {files} to upload.",
        msgFilesTooMany: "Number of files selected for upload <b>({n})</b> exceeds maximum allowed limit of <b>{m}</b>.",
        msgFileNotFound: 'File "{name}" not found!',
        msgFileSecured: 'Security restrictions prevent reading the file "{name}".',
        msgFileNotReadable: 'File "{name}" is not readable.',
        msgFilePreviewAborted: 'File preview aborted for "{name}".',
        msgFilePreviewError: 'An error occurred while reading the file "{name}".',
        msgInvalidFileType: 'Invalid type for file "{name}". Only "{types}" files are supported.',
        msgInvalidFileExtension: 'Invalid extension for file "{name}". Only "{extensions}" files are supported.',
        msgUploadAborted: "The file upload was aborted",
        msgUploadThreshold: "Processing...",
        msgValidationError: "Validation Error",
        msgLoading: "Loading file {index} of {files} &hellip;",
        msgProgress: "Loading file {index} of {files} - {name} - {percent}% completed.",
        msgSelected: "{n} {files} selected",
        msgFoldersNotAllowed: "Drag & drop files only! {n} folder(s) dropped were skipped.",
        msgImageWidthSmall: 'Width of image file "{name}" must be at least {size} px.',
        msgImageHeightSmall: 'Height of image file "{name}" must be at least {size} px.',
        msgImageWidthLarge: 'Width of image file "{name}" cannot exceed {size} px.',
        msgImageHeightLarge: 'Height of image file "{name}" cannot exceed {size} px.',
        msgImageResizeError: "Could not get the image dimensions to resize.",
        msgImageResizeException: "Error while resizing the image.<pre>{errors}</pre>",
        dropZoneTitle: "请选择图片 &hellip;",
        dropZoneClickTitle: "<br>(or click to select {files})",
        previewZoomButtonTitles: {
            prev: "View previous file",
            next: "View next file",
            toggleheader: "Toggle header",
            fullscreen: "Toggle full screen",
            borderless: "Toggle borderless mode",
            close: "Close detailed preview"
        }
    }, a.fn.fileinput.Constructor = oa, a(document).ready(function() {
        var b = a("input.file[type=file]");
        b.length && b.fileinput()
    })
});