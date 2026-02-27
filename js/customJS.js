function customAjax(url, data, callback) {
  $.ajax({
    url: url,
    type: "POST",
    data: data,
    dataType: "json",
    success: function (response) {
      if (callback && typeof callback === "function") {
        callback(response);
      }
    },
  });
}
