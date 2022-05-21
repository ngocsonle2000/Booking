$('input#name').keyup(function(event) {
    var title, slug;
    // lấy text từ thẻ input title
    title = $(this).val();
    console.log($(this).val());
    // đổi chữ hoa thành chữ thường
    slug = title.toLowerCase();

    // đổi kí tự có dấu thành không dấu
    slug = slug.replace(/á|à|ạ|ả|à|ã|ă|ắ|ằ|ẳ|ã|ạ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ế|ề|ể|ẽ|ẹ|ê/gi, 'e');
    slug = slug.replace(/í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ố|ồ|ổ|ỗ|ộ|ớ|ờ|ở|ỡ|ợ|ơ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ứ|ừ|ử|ữ|ự|ư/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    slug = slug.replace(/đ/gi, 'd');

    // xóa các ký tự đặc biệt
    slug = slug.replace(/\~|\`|\!|\@|\#|\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\<|\.|\>|\?|\/|\:|\;|\'|\"|\_/gi, '');

    slug = slug.replace(/ /gi, "-");

    slug = slug.replace(/\-\-\-\-\-/gi, "-");
    slug = slug.replace(/\-\-\-\-/gi, "-");
    slug = slug.replace(/\-\-\-/gi, "-");
    slug = slug.replace(/\-\-/gi, "-");

    slug = '@' + slug + '@';

    slug = slug.replace(/\@\-|\-\@|\@/gi, '');

    $('input#slug').val(slug);

})
