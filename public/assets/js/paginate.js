function pagination(link, tab) {
  var total = parseInt($('#totalPage').val());
  var curPage = parseInt($('#page').val());
  var paginate = $('.pagination');
  paginate.empty();
  var btn = '';
  var end = 0;
  if (curPage > 1) {
    btn =
      '<a  class="go-to-first" href="/' +
      link +
      '?tab=' +
      tab +
      '&page=1" id="pr"> &laquo;</a>';
    btn +=
      '<a  class="go-to-prev"  href="/' +
      link +
      '?tab=' +
      tab +
      '&page=' +
      parseInt(curPage - 1) +
      '">   &lsaquo;</a>';
  } else {
    btn = '<a  class="go-to-first" style="cursor: not-allowed;">&laquo;</a>';
    btn +=
      '<a  class="go-to-prev" style="cursor: not-allowed;">   &lsaquo;</a>';
  }

  if (total < 4 && total > 0) {
    for (var i = 1; i <= total; i++) {
      if (i == curPage)
        btn +=
          '<a class="page-number" style="font-weight: bold;background-color: #36b3df; color: #fff !important" href="/' +
          link +
          '/?tab=' +
          tab +
          '&page=' +
          i +
          '" >' +
          i +
          '</a>';
      else
        btn +=
          '<a class="page-number" href="/' +
          link +
          '?tab=' +
          tab +
          '&page=' +
          i +
          '">' +
          i +
          '</a>';
    }
    if (curPage < total) {
      btn +=
        '<a class="page-number" href="/' +
        link +
        '?tab=' +
        tab +
        '&page=' +
        parseInt(curPage + 1) +
        '">  &rsaquo; </a>';
      btn +=
        '<a class="page-number" href="/' +
        link +
        '?tab=' +
        tab +
        '&page=' +
        parseInt(total) +
        '">&raquo; </a>';
    } else {
      btn +=
        '<a class="page-number" style="cursor: not-allowed;">  &rsaquo; </a>';
      btn += '<a class="page-number" style="cursor: not-allowed;">&raquo; </a>';
    }
    paginate.append(btn);
    return;
  } else if (total == 1) end = 1;
  else if (total - curPage >= 1 && total - curPage <= 3) {
    end = total;
  } else if (curPage + 3 > total) {
    end = total - curPage;
  } else {
    end = curPage + 3;
  }

  if (curPage > 1) {
    btn +=
      '<a class="page-number" href="/' +
      link +
      '?tab=' +
      tab +
      '&page=1">1</a>';
  }
  if (curPage > 2 && curPage - total <= 4) {
    btn +=
      '<a class="page-number" href="/' +
      link +
      '?tab=' +
      tab +
      '&page=' +
      parseInt((curPage - 1) / 2 + 1) +
      '">...</a>';
  }
  for (var i = curPage; i < end; i++) {
    if (i == curPage) {
      btn +=
        '<a class="page-number" style="font-weight: bold;background-color: #36b3df; color: #fff !important" href="#" onclick="getListArticle(' +
        i +
        ')">' +
        i +
        '</a>';
    } else {
      btn +=
        '<a class="page-number" href="/' +
        link +
        '?tab=' +
        tab +
        '&page=' +
        i +
        '">' +
        i +
        '</a>';
    }
  }
  if (curPage + 4 < total && total > 1) {
    var cur =
      parseInt(curPage + 5) < total
        ? parseInt(curPage + 5)
        : parseInt((total - curPage) / 2 + 1);
    btn +=
      '<a class="page-number" href="/' +
      link +
      '?tab=' +
      tab +
      '&page=' +
      cur +
      '">...</a>';
  }
  if (curPage < total) {
    btn +=
      '<a class="page-number" href="/' +
      link +
      '?tab=' +
      tab +
      '&page=' +
      total +
      '">' +
      total +
      '</a>';
  } else if (curPage == total) {
    btn +=
      '<a class="page-number" style="font-weight: bold; background-color: #36b3df; color: #fff"  href="/' +
      link +
      '?tab=' +
      tab +
      '&page=' +
      total +
      '">' +
      total +
      '</a>';
  }
  if (curPage < total) {
    btn +=
      '<a class="go-to-last"   href="/' +
      link +
      '?tab=' +
      tab +
      '&page=' +
      parseInt(curPage + 1) +
      '"> &rsaquo; </a>';
    btn +=
      '<a class="go-to-last"  href="/' +
      link +
      '?tab=' +
      tab +
      '&page=' +
      total +
      '">&raquo; </a>';
  } else {
    btn += '<a class="go-to-last" style="cursor: not-allowed;"> &rsaquo; </a>';
    btn += '<a class="go-to-last" style="cursor: not-allowed;">&raquo; </a>';
  }

  paginate.append(btn);
}
