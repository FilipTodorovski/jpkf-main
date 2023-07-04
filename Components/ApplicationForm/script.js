jQuery(function () {
  jQuery(document).on('gform_post_render', function () {
    jQuery('.jpkf-app-form__gform-file-input-col input[type=file]').on('change', function () {
      const fileName = jQuery(this).val().split('\\').pop()
      jQuery('.jpkf-app-form__gform-file-input-name', jQuery(this).parent().parent().parent()).html(fileName)
    })
  })
})
