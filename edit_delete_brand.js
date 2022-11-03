$(document).ready(function () {
    // Bắt sự kiện click thêm giỏ hàng thêm hiệu ứng animation tới icon giỏ hàng
    $('#delete').on('click', function () {
        var _idbrand = document.getElementById('idbrand').value ;
        console.log(_idbrand);
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: 'delete.php',
                    data: {
                        action: "delete",
                        idbrand: _idbrand,
                    },
                    success: function (data) {
                      var data = JSON.parse(data);
                      console.log(data);
                      if(data['key'] == 'Xóa thành công'){
                        Swal.fire(
                          'Deleted!',
                          'Your file has been deleted.',
                          'success'
                        )
                      }
                    }     
                });
            }
          })
    });

    $('#edit').on('click', function () {
      var _idbrand = document.getElementById('idbrand').value ;
      var _namebrand = document.getElementById('namebrand').value;  
      console.log(_idbrand);
      console.log(_namebrand);
      Swal.fire({
        title: 'Do you want to save the changes?',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Save',
        denyButtonText: `Don't save`,
      }).then((result) => {
          if (result.isConfirmed) {
              $.ajax({
                  type: 'POST',
                  url: 'edit.php',
                  data: {
                      action: "edit",
                      idbrand: _idbrand,
                      namebrand: _namebrand,
                  },
                  success: function (data) {
                    var data = JSON.parse(data);
                    console.log(data);
                    if(data['key'] == 'Sửa thành công'){
                      Swal.fire('Saved!', '', 'success')
                    }
                  }     
              });
          }else{
            Swal.fire('Changes are not saved', '', 'info')
          }

        })
  });


  $('#insert').on('click', function () {
    var _idbrand = document.getElementById('idbrand').value ;
    var _namebrand = document.getElementById('namebrand').value;  
    console.log(_idbrand);
    console.log(_namebrand);
    Swal.fire({
      title: 'Do you want to save the product?',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: 'xulyaddbrand.php',
                data: {
                    action: "insert",
                    idbrand: _idbrand,
                    namebrand: _namebrand,
                },
                success: function (data) {
                  var data = JSON.parse(data);
                  console.log(data);
                  if(data['key'] == 'Thêm thành công'){
                    Swal.fire('Saved!', '', 'success')
                  }if(data['key']== 'Trùng tên nhãn hàng')
                  {  
                    Swal.fire('Trùng tên nhãn hàng')
                  }if(data['key']== 'Trùng mã nhãn hàng')
                  {  
                    Swal.fire('Trùng mã nhãn hàng')
                  }
                }     
            });
        }else{
          Swal.fire('Changes are not saved', '', 'info')
        }

      })
});
});
