(new Dashboard()).getProduct();

function Dashboard() {
    this.getProduct = () => {
        DashboardClient.get(DashboardClient.domainUrl() + "/v1/projects")
            .then((response) => {
                if (response.status === true) {
                    let data = response.data;
                    $.each(data,function (key,val){
                        $("#shoeProject").append(`
                            <tr>
                                    <td>
                                        <div class="d-flex px-2">
                                            <div class="my-auto">
                                                <h6 class="mb-0 text-sm">${val.id ? val.id : '--'}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2">
                                            <div class="my-auto">
                                                <h6 class="mb-0 text-sm">${val.name ? val.name : '--'}</h6>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">${val.budget ? val.budget : '--'}</p>
                                    </td>
                                    <td>
                                        <span class="text-xs font-weight-bold">${val.responsible_user ? val.responsible_user : '--'}</span>
                                    </td>
                                    <td>
                                        <span class="text-xs font-weight-bold">${val.status ? val.status : '--'}</span>
                                    </td>
                                    
                                    <td class="align-middle text-center">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <span class="me-2 text-xs font-weight-bold">${val.created_at ? val.created_at : '--'}</span>
                                        </div>
                                    </td>
                                    <td>                                       
                                        <a class="btn btn-link text-dark px-3 mb-0" href="javascript: editProject(${val.id});"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i></a>
                                        <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript: deleteProject(${val.id});"><i class="far fa-trash-alt" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                        `);
                    });
                }
            })
            .catch((error) => {
                console.log(error.responseJSON)
            })
    };
}
function editProject(id){
    alert(id)
}
function deleteProject(id){
    alert(id)
}