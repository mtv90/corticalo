import swal from 'sweetalert';
let axios = require('axios');


$('body').on('click', '.delete-study', function(){

        swal({
            title: "Sind Sie sicher?",
            text: "Einmal gelöscht, lässt es sich nicht mehr rückgängig machen!",
            icon: "warning",
            buttons: ["abbrechen", "löschen"],
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                let id = $(this).data('id');
                axios.delete('/studies/'+id)
                    .then(function(){
                        swal("Eintrag wurde gelöscht!", {
                            icon: "success",
                        });
                        setTimeout(function(){ 
                            window.location.reload();
                        }, 1000);
                    })
                    .catch(function(error){
                        
                        console.log(error);
                    });
            }else{
                console.log("Löschen abgebrochen")
            } 
        });
});

$('body').on('click', '.delete-form', function(){
    swal({
        title: "Sind Sie sicher?",
        text: "Einmal gelöscht, lässt es sich nicht mehr rückgängig machen!",
        icon: "warning",
        buttons: ["abbrechen", "löschen"],
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            let id = $(this).data('id');
        
            axios.delete('/forms/'+id)
                .then(res =>{
                    swal("Eintrag wurde gelöscht!", {
                        icon: "success",
                    });
                    setTimeout(function(){ 
                        window.location.reload();
                    }, 1000);
                })
                .catch(err =>{
                    console.log(err);
                });
        }else{
            console.log("Löschen abgebrochen")
        } 
    });
});

$('body').on('click', '.delete-crf', function(){
    swal({
        title: "Sind Sie sicher?",
        text: "Einmal gelöscht, lässt es sich nicht mehr rückgängig machen!",
        icon: "warning",
        buttons: ["abbrechen", "löschen"],
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            let id = $(this).data('id');
            axios.delete('/crfs/'+id)
                .then(res => {
                    swal("Eintrag wurde gelöscht!", {
                        icon: "success",
                    });
                    setTimeout(function(){ 
                        window.location.reload();
                    }, 1000);  
                })
                .catch(err =>{
                    console.log(err);
                });
        }else{
            console.log("Löschen abgebrochen")
        } 
    });
});

$('body').on('click', '.delete-ch', function(){

    swal({
        title: "Sind Sie sicher?",
        text: "Einmal gelöscht, lässt es sich nicht mehr rückgängig machen!",
        icon: "warning",
        buttons: ["abbrechen", "löschen"],
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            let id = $(this).data('id');
            axios.delete('/choices/'+id)
                .then(function(){
                    swal("Eintrag wurde gelöscht!", {
                        icon: "success",
                    });
                    setTimeout(function(){ 
                        window.location.reload();
                    }, 1000);
                })
                .catch(err =>{
                    console.log(err);
                });
        }else{
            console.log("Löschen abgebrochen")
        } 
    });
});

$('body').on('click', '.delete-result', function(){
    let id = $(this).data('id');
    
    axios.delete('/answers/'+id)
        .then(function(){
            window.location.reload('/answers');
            alert('funzt');
        })
        .catch(function(error){
            console.log(error);
        });
});


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

 