<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Summernote</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
</head>
<body>
<section class="archive-area section_padding_80">
        <div class="container">
            <div class="row">

                        <div class="col-12 col-md-12 item">
                        <div class="contact-form wow fadeInUpBig" data-wow-delay="0.6s">
                            
                            <!-- Contact Form -->
                            <form action="#" method="post">
                            
                            <input type="hidden" name="imgUrl" id="imgUrl" value="">
                            <input type="hidden" name="attachFile" id="attachFile" value="">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="subject" placeholder="제목">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="childName" placeholder="태그">
                                </div>
                                <div class="form-group">
                                <div id="summernote"></div>
                                </div>
                                <div class="form-group">
                                    <div id="attach_site">
                                        <div id="attachFiles">
                                        </div>
                                        <input type="file" multiple class="form-input" name="afile" id="afile" />
                                    </div>
                                </div>
                                <button type="button" class="btn contact-btn"  onclick="saveUp();">WRITE</button>
                            </form>
                        </div>
                    </div>

            

                
                

            </div>
        </div>
    </section>  
</body>

<script>
     $(document).ready(function() {
      $('#nttCn').summernote({
        placeholder: '글을 입력해 주세요',
        height: 500,
        lang: 'ko-KR',
        toolbar: [
                    // [groupName, [list of button]]
                    ['Font Style', ['fontname']],
                    ['style', ['bold', 'italic', 'underline']],
                    ['font', ['strikethrough']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['paragraph']],
                    ['height', ['height']],
                    ['Insert', ['picture']],
                    ['Insert', ['link']],
                    ['Misc', ['fullscreen']]
                 ]
      });
    });
  </script>