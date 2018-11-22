
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Halaman Berkas</title>

    <link href="{{ asset('templates/inspinia_271/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="{{ asset('templates/inspinia_271/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('templates/inspinia_271/css/style.css') }}" rel="stylesheet">

</head>

<body class="top-navigation">

    <div id="wrapper">
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom white-bg">
                <nav class="navbar navbar-static-top" role="navigation">
                    <div class="navbar-header">
                        <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                            <i class="fa fa-reorder"></i>
                        </button>
                        <a href="#" class="navbar-brand">Inspinia</a>
                    </div>
                    <div class="navbar-collapse collapse" id="navbar">
                        <ul class="nav navbar-nav">
                            {{-- <li class="active">
                                <a aria-expanded="false" role="button" href="layouts.html"> Back to main Layout page</a>
                            </li> --}}
                            
                            
                            
                            

                        </ul>
                        <ul class="nav navbar-top-links navbar-right">
                            <li>
                                <a href="login.html">
                                    <i class="fa fa-sign-out"></i> Log out
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="wrapper wrapper-content">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-content">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <colgroup>
                                                <col width="10%">
                                                <col width="1%">
                                                <col>
                                            </colgroup>
                                            <tr>
                                                <th>No Perkara</th>
                                                <td>:</td>
                                                <td>{{ $berkas->perkara->no_perkara }}</td>
                                            </tr>
                                            <tr>
                                                <th>Nama Berkas</th>
                                                <td>:</td>
                                                <td>{{ $berkas->nama }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <div class="ibox-tools">
                                        <div class="text-center pdf-toolbar">

                                            <div class="btn-group">
                                                <button id="prev" class="btn btn-white"><i class="fa fa-long-arrow-left"></i> <span class="hidden-xs">Previous</span></button>
                                                <button id="next" class="btn btn-white"><i class="fa fa-long-arrow-right"></i> <span class="hidden-xs">Next</span></button>
                                                <button id="zoomin" class="btn btn-white"><i class="fa fa-search-minus"></i> <span class="hidden-xs">Zoom In</span></button>
                                                <button id="zoomout" class="btn btn-white"><i class="fa fa-search-plus"></i> <span class="hidden-xs">Zoom Out</span> </button>
                                                <button id="zoomfit" class="btn btn-white"> 100%</button>
                                                <span class="btn btn-white hidden-xs">Page: </span>

                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="page_num">

                                                    <div class="input-group-btn">
                                                        <button type="button" class="btn btn-white" id="page_count">/ 22</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ibox-content">

                                    <div class="text-center m-t-md">
                                        <canvas id="the-canvas" class="pdfcanvas border-left-right border-top-bottom b-r-md"></canvas>
                                    </div>
                                </div>
                                <div class="ibox-footer">

                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>
                </div>

            </div>
            <div class="footer">
                {{-- <div class="pull-right">
                    10GB of <strong>250GB</strong> Free.
                </div> --}}
                <div>{{-- 
                    <strong>Copyright</strong> Example Company &copy; 2014-2017
                 --}}</div>
            </div>

        </div>
    </div>



    <!-- Mainly scripts -->
    <script src="{{ asset('templates/inspinia_271/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('templates/inspinia_271/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('templates/inspinia_271/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('templates/inspinia_271/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('templates/inspinia_271/js/plugins/pdfjs/pdf.js') }}"></script>
    <script src="{{ asset('plugins/axios/dist/axios.min.js') }}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('templates/inspinia_271/js/inspinia.js') }}"></script>
    <script src="{{ asset('templates/inspinia_271/js/plugins/pace/pace.min.js') }}"></script>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <script id="script">
        //
        // If absolute URL from the remote server is provided, configure the CORS
        // header on that server.
        {{-- var url = '{{ Storage::url('berkas-perkara/3KS0AVEqhScvNCX3j1xAo6idiOF2oiTs5EZiZvL1.pdf') }}'; --}}


        var pdfDoc = null,
        pageNum = 1,
        pageRendering = false,
        pageNumPending = null,
        scale = 1.5,
        zoomRange = 0.25,
        canvas = document.getElementById('the-canvas'),
        ctx = canvas.getContext('2d');

        /**
         * Get page info from document, resize canvas accordingly, and render page.
         * @param num Page number.
         */
         function renderPage(num, scale) {
            pageRendering = true;
            // Using promise to fetch the page
            pdfDoc.getPage(num).then(function(page) {
                var viewport = page.getViewport(scale);
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                // Render PDF page into canvas context
                var renderContext = {
                    canvasContext: ctx,
                    viewport: viewport
                };
                var renderTask = page.render(renderContext);

                // Wait for rendering to finish
                renderTask.promise.then(function () {
                    pageRendering = false;
                    if (pageNumPending !== null) {
                        // New page rendering is pending
                        renderPage(pageNumPending);
                        pageNumPending = null;
                    }
                });
            });

            // Update page counters
            document.getElementById('page_num').value = num;
        }

        /**
         * If another page rendering in progress, waits until the rendering is
         * finised. Otherwise, executes rendering immediately.
         */
         function queueRenderPage(num) {
            if (pageRendering) {
                pageNumPending = num;
            } else {
                renderPage(num,scale);
            }
        }

        /**
         * Displays previous page.
         */
         function onPrevPage() {
            if (pageNum <= 1) {
                return;
            }
            pageNum--;
            var scale = pdfDoc.scale;
            queueRenderPage(pageNum, scale);
        }
        document.getElementById('prev').addEventListener('click', onPrevPage);

        /**
         * Displays next page.
         */
         function onNextPage() {
            if (pageNum >= pdfDoc.numPages) {
                return;
            }
            pageNum++;
            var scale = pdfDoc.scale;
            queueRenderPage(pageNum, scale);
        }
        document.getElementById('next').addEventListener('click', onNextPage);

        /**
         * Zoom in page.
         */
         function onZoomIn() {
            if (scale >= pdfDoc.scale) {
                return;
            }
            scale += zoomRange;
            var num = pageNum;
            renderPage(num, scale)
        }
        document.getElementById('zoomin').addEventListener('click', onZoomIn);

        /**
         * Zoom out page.
         */
         function onZoomOut() {
            if (scale >= pdfDoc.scale) {
                return;
            }
            scale -= zoomRange;
            var num = pageNum;
            queueRenderPage(num, scale);
        }
        document.getElementById('zoomout').addEventListener('click', onZoomOut);

        /**
         * Zoom fit page.
         */
         function onZoomFit() {
            if (scale >= pdfDoc.scale) {
                return;
            }
            scale = 1;
            var num = pageNum;
            queueRenderPage(num, scale);
        }
        document.getElementById('zoomfit').addEventListener('click', onZoomFit);


        /**
         * Asynchronously downloads PDF.
         */
         $(function() {
            axios.get('{{ route('perkara.get_file', $berkasID) }}')
            .then(resp => {
                res = resp.data;
                let url = res.url;
                PDFJS.getDocument(url).then(function (pdfDoc_) {
                    pdfDoc = pdfDoc_;
                    var documentPagesNumber = pdfDoc.numPages;
                    document.getElementById('page_count').textContent = '/ ' + documentPagesNumber;

                    $('#page_num').on('change', function() {
                        var pageNumber = Number($(this).val());

                        if(pageNumber > 0 && pageNumber <= documentPagesNumber) {
                            queueRenderPage(pageNumber, scale);
                        }

                    });

            // Initial/first page rendering
            renderPage(pageNum, scale);
        });

            });

        });
    </script>

</body>

</html>
