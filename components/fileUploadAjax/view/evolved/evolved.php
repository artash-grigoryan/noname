<? if(!empty($this->_params['iframe'])): ?>
    <script src="<?=MOTOR_PATH?>lib/js/jquery-2.0.3.min.js" type="text/javascript"></script>
    <script src="<?=MOTOR_PATH?>lib/js/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<? endif; ?>
<!-- Bootstrap CSS Toolkit styles -->
<link rel="stylesheet" href="<?=FILEUPLOADAJAX_PATH?>css/bootstrap.dev.css">   
<!-- Bootstrap CSS fixes for IE6 -->
<!--[if lt IE 7]><link rel="stylesheet" href="http://blueimp.github.com/cdn/css/bootstrap-ie6.min.css"><![endif]-->
<!-- Bootstrap Image Gallery styles -->
<link rel="stylesheet" href="<?=FILEUPLOADAJAX_PATH?>css/bootstrap-image-gallery.min.css">

<!-- CSS adjustments for browsers with JavaScript disabled -->
<noscript><link rel="stylesheet" href="<?=FILEUPLOADAJAX_PATH?>css/jquery.fileupload-ui-noscript.css"></noscript>

<!-- The file upload form used as target for the file upload widget -->
<form id="fileupload" action="javascript:;" method="POST" enctype="multipart/form-data" data-ng-app="demo" data-ng-controller="DemoFileUploadController" data-fileupload="options" ng-class="{true: 'fileupload-processing'}[!!processing() || loadingFiles]">
    <!-- Redirect browsers with JavaScript disabled to the origin page -->
    <noscript><span style="color:red">Veuillez activer Javascript</span></noscript>
    <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
    <div class="row fileupload-buttonbar">
        <div class="span7">
            <!-- The fileinput-button span is used to style the file input field as button -->
            <span class="btn btn-success fileinput-button">
                <i class="icon-plus icon-white"></i>
                <input type="file" name="files[]" multiple>
            </span>
            <button type="button" class="btn btn-primary start" data-ng-click="submit()">
                <i class="icon-upload icon-white"></i>
                <span>Start upload</span>
            </button>
            <button type="button" class="btn btn-warning cancel" data-ng-click="cancel()">
                <i class="icon-ban-circle icon-white"></i>
                <span>Cancel upload</span>
            </button>
            <!-- The loading indicator is shown during file processing -->
            <div class="fileupload-loading"></div>
        </div>
    </div>
    <!-- The table listing the files available for upload/download -->
    <table class="table table-striped files ng-cloak" data-toggle="modal-gallery" data-target="#modal-gallery">
        <tr data-ng-repeat="file in queue">
            <td data-ng-switch on="!!file.thumbnail_url">
                <div class="preview" data-ng-switch-when="true">
                    <a data-ng-href="{{file.url}}" title="{{file.name}}" data-gallery="gallery" download="{{file.name}}"><img data-ng-src="{{file.thumbnail_url}}"></a>
                </div>
                <div class="preview" data-ng-switch-default data-preview="file"></div>
            </td>
            <td style="display:none">
                <p class="name" data-ng-switch on="!!file.url">
                    <a data-ng-switch-when="true" data-ng-href="{{file.url}}" title="{{file.name}}" data-gallery="gallery" download="{{file.name}}">{{file.name}}</a>
                    <span data-ng-switch-default>{{file.name}}</span>
                </p>
                <div ng-show="file.error"><span class="label label-important">Error</span> {{file.error}}</div>
            </td>
            <td style="display:none">
                <p class="size">{{file.size | formatFileSize}}</p>
                <div class="progress progress-success progress-striped active fade" data-ng-class="{pending: 'in'}[file.$state()]" data-progress="file.$progress()"><div class="bar" ng-style="{width: num + '%'}"></div></div>
            </td>
            <td>
                <button type="button" class="btn btn-primary start" data-ng-click="file.$submit()" data-ng-hide="!file.$submit">
                    <i class="icon-upload icon-white"></i>
                    <span>Start</span>
                </button>
                <button type="button" class="btn btn-warning cancel" data-ng-click="file.$cancel()" data-ng-hide="!file.$cancel">
                    <i class="icon-ban-circle icon-white"></i>
                    <span>Cancel</span>
                </button>
                <button data-ng-controller="FileDestroyController" type="button" class="btn btn-danger destroy" data-ng-click="file.$destroy()" data-ng-hide="!file.$destroy">
                    <i class="icon-ban-circle icon-white"></i>
                    <span>Delete</span>
                </button>
            </td>
        </tr>
    </table>
</form>
    
<!-- modal-gallery is the modal dialog used for the image gallery -->
<div id="modal-gallery" class="modal modal-gallery hide fade" data-filter=":odd" tabindex="-1">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3 class="modal-title"></h3>
    </div>
    <div class="modal-body"><div class="modal-image"></div></div>
    <div class="modal-footer">
        <a class="btn modal-download" target="_blank">
            <i class="icon-download"></i>
            <span>Download</span>
        </a>
        <a class="btn btn-success modal-play modal-slideshow" data-slideshow="5000">
            <i class="icon-play icon-white"></i>
            <span>Slideshow</span>
        </a>
        <a class="btn btn-info modal-prev">
            <i class="icon-arrow-left icon-white"></i>
            <span>Previous</span>
        </a>
        <a class="btn btn-primary modal-next">
            <span>Next</span>
            <i class="icon-arrow-right icon-white"></i>
        </a>
    </div>
</div>

<script src="<?=FILEUPLOADAJAX_PATH?>js/angular.min.js"></script>
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="<?=FILEUPLOADAJAX_PATH?>js/vendor/jquery.ui.widget.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<!-- <script src="http://blueimp.github.com/JavaScript-Load-Image/load-image.min.js"></script> -->
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<!-- <script src="http://blueimp.github.com/JavaScript-Canvas-to-Blob/canvas-to-blob.min.js"></script> -->
<!-- Bootstrap JS and Bootstrap Image Gallery are not required, but included for the demo -->
<script src="<?=FILEUPLOADAJAX_PATH?>js/bootstrap.min.js"></script>
<script src="<?=FILEUPLOADAJAX_PATH?>js/bootstrap-image-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?=FILEUPLOADAJAX_PATH?>js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="<?=FILEUPLOADAJAX_PATH?>js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="<?=FILEUPLOADAJAX_PATH?>js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="<?=FILEUPLOADAJAX_PATH?>js/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="<?=FILEUPLOADAJAX_PATH?>js/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script src="<?=FILEUPLOADAJAX_PATH?>js/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="<?=FILEUPLOADAJAX_PATH?>js/jquery.fileupload-validate.js"></script>
<!-- The File Upload Angular JS module 
<script src="<?=FILEUPLOADAJAX_PATH?>js/jquery.fileupload-angular.js"></script>
<!-- The main application script 
<script src="<?=FILEUPLOADAJAX_PATH?>js/app.js"></script>-->

<script type="text/javascript">
    (function (factory) {
        'use strict';
        if (typeof define === 'function' && define.amd) {
            // Register as an anonymous AMD module:
            define([
                'jquery',
                'angular',
                './jquery.fileupload-image',
                './jquery.fileupload-audio',
                './jquery.fileupload-video',
                './jquery.fileupload-validate'
            ], factory);
        } else {
            factory();
        }
    }(function () {
        'use strict';

        angular.module('blueimp.fileupload', [])

            .provider('fileUpload', function () {
                var scopeApply = function () {
                        var scope = angular.element(this)
                            .fileupload('option', 'scope')();
                        if (!scope.$$phase) {
                            scope.$apply();
                        }
                    },
                    $config;
                $config = this.defaults = {
                    handleResponse: function (e, data) {
                        var files = data.result && data.result.files;
                        if (files) {
                            data.scope().replace(data.files, files);
                        } else if (data.errorThrown ||
                                data.textStatus === 'error') {
                            data.files[0].error = data.errorThrown ||
                                data.textStatus;
                        }
                    },
                    add: function (e, data) {
                        var scope = data.scope();
                        data.process(function () {
                            return scope.process(data);
                        }).always(
                            function () {
                                var file = data.files[0],
                                    submit = function () {
                                        return data.submit();
                                    };
                                file.$cancel = function () {
                                    scope.clear(data.files);
                                    return data.abort();
                                };
                                file.$state = function () {
                                    return data.state();
                                };
                                file.$progress = function () {
                                    return data.progress();
                                };
                                file.$response = function () {
                                    return data.response();
                                };
                                if (file.$state() === 'rejected') {
                                    file._$submit = submit;
                                } else {
                                    file.$submit = submit;
                                }
                                scope.$apply(function () {
                                    var method = scope.option('prependFiles') ?
                                            'unshift' : 'push';
                                    Array.prototype[method].apply(
                                        scope.queue,
                                        data.files
                                    );
                                    if (file.$submit &&
                                            (scope.option('autoUpload') ||
                                            data.autoUpload) &&
                                            data.autoUpload !== false) {
                                        file.$submit();
                                    }
                                });
                            }
                        );
                    },
                    progress: function (e, data) {
                        data.scope().$apply();
                    },
                    done: function (e, data) {
                        var that = this;
                        if(typeof callbackDoneFileUploadAjax == 'function') {
                            callbackDoneFileUploadAjax(data);
                        }
                        else {
                            console.log('callbackDoneFileUploadAjax() can be called');
                        }
                        data.scope().$apply(function () {
                            data.handleResponse.call(that, e, data);
                        });
                    },
                    fail: function (e, data) {
                        var that = this;
                        if(typeof callbackFailFileUploadAjax == 'function') {
                            callbackFailFileUploadAjax(data);
                        }
                        else {
                            console.log('callbackFailFileUploadAjax() can be called');
                        }
                        if (data.errorThrown === 'abort') {
                            return;
                        }
                        if (data.dataType &&
                                data.dataType.indexOf('json') === data.dataType.length - 4) {
                            try {
                                data.result = angular.fromJson(data.jqXHR.responseText);
                            } catch (ignore) {}
                        }
                        data.scope().$apply(function () {
                            data.handleResponse.call(that, e, data);
                        });
                    },
                    stop: scopeApply,
                    processstart: scopeApply,
                    processstop: scopeApply,
                    getNumberOfFiles: function () {
                        return this.scope().queue.length;
                    },
                    dataType: 'json',
                    prependFiles: true,
                    autoUpload: false
                };
                this.$get = [
                    function () {
                        return {
                            defaults: $config
                        };
                    }
                ];
            })

            .provider('formatFileSizeFilter', function () {
                var $config = this.defaults = {
                    // Byte units following the IEC format
                    // http://en.wikipedia.org/wiki/Kilobyte
                    units: [
                        {size: 1000000000, suffix: ' GB'},
                        {size: 1000000, suffix: ' MB'},
                        {size: 1000, suffix: ' KB'}
                    ]
                };
                this.$get = function () {
                    return function (bytes) {
                        if (!angular.isNumber(bytes)) {
                            return '';
                        }
                        var unit = true,
                            i = -1;
                        while (unit) {
                            unit = $config.units[i += 1];
                            if (i === $config.units.length - 1 || bytes >= unit.size) {
                                return (bytes / unit.size).toFixed(2) + unit.suffix;
                            }
                        }
                    };
                };
            })

            .controller('FileUploadController', [
                '$scope', '$element', '$attrs', 'fileUpload',
                function ($scope, $element, $attrs, fileUpload) {
                    $scope.disabled = angular.element('<input type="file">')
                        .prop('disabled');
                    $scope.queue = $scope.queue || [];
                    $scope.clear = function (files) {
                        var queue = this.queue,
                            i = queue.length,
                            file = files,
                            length = 1;
                        if (angular.isArray(files)) {
                            file = files[0];
                            length = files.length;
                        }
                        while (i) {
                            if (queue[i -= 1] === file) {
                                return queue.splice(i, length);
                            }
                        }
                    };
                    $scope.replace = function (oldFiles, newFiles) {
                        var queue = this.queue,
                            file = oldFiles[0],
                            i,
                            j;
                        for (i = 0; i < queue.length; i += 1) {
                            if (queue[i] === file) {
                                for (j = 0; j < newFiles.length; j += 1) {
                                    queue[i + j] = newFiles[j];
                                }
                                return;
                            }
                        }
                    };
                    $scope.progress = function () {
                        return $element.fileupload('progress');
                    };
                    $scope.active = function () {
                        return $element.fileupload('active');
                    };
                    $scope.option = function (option, data) {
                        return $element.fileupload('option', option, data);
                    };
                    $scope.add = function (data) {
                        return $element.fileupload('add', data);
                    };
                    $scope.send = function (data) {
                        return $element.fileupload('send', data);
                    };
                    $scope.process = function (data) {
                        return $element.fileupload('process', data);
                    };
                    $scope.processing = function (data) {
                        return $element.fileupload('processing', data);
                    };
                    $scope.applyOnQueue = function (method) {
                        var list = this.queue.slice(0),
                            i,
                            file;
                        for (i = 0; i < list.length; i += 1) {
                            file = list[i];
                            if (file[method]) {
                                file[method]();
                            }
                        }
                    };
                    $scope.submit = function () {
                        this.applyOnQueue('$submit');
                    };
                    $scope.cancel = function () {
                        this.applyOnQueue('$cancel');
                    };
                    // The fileupload widget will initialize with
                    // the options provided via "data-"-parameters,
                    // as well as those given via options object:
                    $element.fileupload(angular.extend(
                        {scope: function () {
                            return $scope;
                        }},
                        fileUpload.defaults
                    )).on('fileuploadadd', function (e, data) {
                        data.scope = $scope.option('scope');
                    }).on([
                        'fileuploadadd',
                        'fileuploadsubmit',
                        'fileuploadsend',
                        'fileuploaddone',
                        'fileuploadfail',
                        'fileuploadalways',
                        'fileuploadprogress',
                        'fileuploadprogressall',
                        'fileuploadstart',
                        'fileuploadstop',
                        'fileuploadchange',
                        'fileuploadpaste',
                        'fileuploaddrop',
                        'fileuploaddragover',
                        'fileuploadchunksend',
                        'fileuploadchunkdone',
                        'fileuploadchunkfail',
                        'fileuploadchunkalways',
                        'fileuploadprocessstart',
                        'fileuploadprocess',
                        'fileuploadprocessdone',
                        'fileuploadprocessfail',
                        'fileuploadprocessalways',
                        'fileuploadprocessstop'
                    ].join(' '), function (e, data) {
                        $scope.$emit(e.type, data);
                    });
                    // Observe option changes:
                    $scope.$watch(
                        $attrs.fileupload,
                        function (newOptions, oldOptions) {
                            if (newOptions) {
                                $element.fileupload('option', newOptions);
                            }
                        }
                    );
                }
            ])

            .controller('FileUploadProgressController', [
                '$scope', '$attrs', '$parse',
                function ($scope, $attrs, $parse) {
                    var fn = $parse($attrs.progress),
                        update = function () {
                            var progress = fn($scope);
                            if (!progress || !progress.total) {
                                return;
                            }
                            $scope.num = Math.floor(
                                progress.loaded / progress.total * 100
                            );
                        };
                    update();
                    $scope.$watch(
                        $attrs.progress + '.loaded',
                        function (newValue, oldValue) {
                            if (newValue !== oldValue) {
                                update();
                            }
                        }
                    );
                }
            ])

            .controller('FileUploadPreviewController', [
                '$scope', '$element', '$attrs', '$parse',
                function ($scope, $element, $attrs, $parse) {
                    var fn = $parse($attrs.preview),
                        file = fn($scope);
                    if (file.preview) {
                        $element.append(file.preview);
                    }
                }
            ])

            .directive('fileupload', function () {
                return {
                    controller: 'FileUploadController'
                };
            })

            .directive('progress', function () {
                return {
                    controller: 'FileUploadProgressController'
                };
            })

            .directive('preview', function () {
                return {
                    controller: 'FileUploadPreviewController'
                };
            })

            .directive('download', function () {
                return function (scope, elm, attrs) {
                    elm.on('dragstart', function (e) {
                        try {
                            e.originalEvent.dataTransfer.setData(
                                'DownloadURL',
                                [
                                    'application/octet-stream',
                                    elm.prop('download'),
                                    elm.prop('href')
                                ].join(':')
                            );
                        } catch (ignore) {}
                    });
                };
            });

    }));

    (function () {
        'use strict';

        var isOnGitHub = window.location.hostname === 'blueimp.github.com' ||
                window.location.hostname === 'blueimp.github.io',
            url = '<?=PATH?>fileUploadAjax/<?=$this->_params['action']?>/?mode=ajax&<?=Controller::setHtmlParams($this->_params)?>';

        angular.module('demo', [
            'blueimp.fileupload'
        ])
            .config([
                '$httpProvider', 'fileUploadProvider',
                function ($httpProvider, fileUploadProvider) {
                    if (isOnGitHub) {
                        // Demo settings:
                        delete $httpProvider.defaults.headers.common['X-Requested-With'];
                        angular.extend(fileUploadProvider.defaults, {
                            disableImageResize: false,
                            maxFileSize: 5000000,
                            acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i
                        });
                    }
                }
            ])

            .controller('DemoFileUploadController', [
                '$scope', '$http',
                function ($scope, $http) {
                    if (!isOnGitHub) {
                        $scope.loadingFiles = true;
                        $scope.options = {
                            url: url + '&upload=1'
                        };
                        $http.get(url)
                            .then(
                                function (response) {
                                    $scope.loadingFiles = false;
                                    $scope.queue = response.data.files || [];
                                },
                                function () {
                                    $scope.loadingFiles = false;
                                }
                            );
                    }
                }
            ])

            .controller('FileDestroyController', [
                '$scope', '$http',
                function ($scope, $http) {
                    var file = $scope.file,
                        state;
                    if (file.url) {
                        file.$state = function () {
                            return state;
                        };
                        file.$destroy = function () {
                            state = 'pending';
                            return $http({
                                url: file.delete_url + '&delete=1',
                                method: file.delete_type
                            }).then(
                                function () {
                                    state = 'resolved';
                                    if(typeof callbackDeleteFileUploadAjax == 'function') {
                                        callbackDeleteFileUploadAjax(file);
                                    }
                                    else {
                                        console.log('callbackDeleteFileUploadAjax() can be called');
                                    }
                                    $scope.clear(file);
                                },
                                function () {
                                    state = 'rejected';
                                }
                            );
                        };
                    } else if (!file.$cancel) {
                        file.$cancel = function () {
                            $scope.clear(file);
                        };
                    }
                }
            ]);

    }());
</script>
