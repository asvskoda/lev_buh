const baseUrl = window.location.origin + '/admin/seo'

const requestGetEditorTemplate = (id) => {
    return $.ajax({
        url: baseUrl + '/get-editor-template',
        type: 'get',
        data: {id},
    })
}

const requestDelete = (id) => {
    return $.ajax({
        url: baseUrl + '/delete?id=' + id,
        type: 'post',
        data: {id},
    })
}
