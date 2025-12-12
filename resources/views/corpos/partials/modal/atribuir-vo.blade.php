 <!--Atribuir VO Modal -->
 <div class="modal fade text-left" id="atribuirvo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
     aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title" id="myModalLabel33">Atribuir VO</h4>
                 <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                     <i data-feather="x"></i>
                 </button>
             </div>

             <div class="modal-body">
                 <div id="logarform">
                     <p>É necessário realizar o login novamente para confirmar que é você mesmo.</p>
                     <label>CPF: </label>
                     <div class="form-group">
                         <input type="text" placeholder="CPF" class="form-control" name="cpf" id="cpf">
                     </div>
                     <label>Senha: </label>
                     <div class="form-group">
                         <input type="password" placeholder="Senha" class="form-control" name="senha" id="senha">
                     </div>
                 </div>
                 <form action="{{ route('corpos.atribuirvo') }}" method="post" id="form">
                     @csrf
                     <input type="hidden" name="corpo_id" value="{{ $corpo->id }}">
                     <div id="necrotomistaform" style="display:none;">
                         <p>Atribua um número da VO ao corpo de <strong>{{ $corpo->nome }}</strong></p>
                         <div class="row">
                             <div class="col-6">
                                 <label for="">Número da VO</label> {{--  --}}
                                 <input type="number" id="num_vo" name="num_vo" class="form-control"
                                     value="{{ $num_vo }}">
                                                            
                             </div>
                             <div class="col-6">
                                 <label for="">Ano da VO</label>
                                 <input type="number" id="ano_vo" name="ano_vo" class="form-control"
                                     value="{{ $ano_vo }}">
                             </div>
                         </div>
                         <p class="small">O número de VO é preenchido automaticamente com próximo número da lista.</p>
                     </div>

             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                     <i class="bx bx-x d-block d-sm-none"></i>
                     <span class="d-none d-sm-block">Fechar</span>
                 </button>
                 <button type="button" class="btn btn-primary ml-1" onclick="verificarIdentidade()"
                     id="verificarbutton">
                     <i class="bx bx-check d-block d-sm-none"></i>
                     <span class="d-none d-sm-block">Entrar</span>
                 </button>
                 <button type="button" class="btn btn-primary ml-1" style="display:none;" onclick="atribuirVO()"
                     id="confirmarbutton">
                     <i class="bx bx-check d-block d-sm-none"></i>
                     <span class="d-none d-sm-block">Confirmar</span>
                 </button>
             </div>
             </form>
         </div>
     </div>
 </div>

 @section('js')
     @parent
     <script>
         function verificarIdentidade() {
             let url = '{{ URL::to('/api/verificaridentidade') }}';
             let data = {
                 cpf: document.querySelector('#cpf').value,
                 senha: document.querySelector('#senha').value
             }
             axios.post(url, data)
                 .then(function(response) {
                     if (response.data.code == 0) {
                         document.getElementById('logarform').style = "display:none;"
                         document.getElementById('necrotomistaform').style = "display:block;"
                         document.getElementById('verificarbutton').style = "display:none;"
                         document.getElementById('confirmarbutton').style = "display:block;"



                     } else {
                         flasher.error(response.data.message);
                     }
                 })
                 .catch(function(error) {
                     console.error(error);
                 });
         }

         function atribuirVO() {
             let form = $('#form');
             let numeroVOElemento = document.querySelector('#num_vo').value;
             let anoVOElemento = document.querySelector('#ano_vo').value;
             let numVO = `${numeroVOElemento}/${anoVOElemento}`;
             let nomeCorpo = "{{ $corpo->nome }}";

             swal.fire({
                 title: "Atribuir VO?",
                 html: "Tem certeza que deseja atribuir a VO de número <strong>" + numVO +
                     "</strong> ao corpo de <strong>" + nomeCorpo +
                     "</strong>? Uma vez feita, não tem como desfazer!",
                 icon: "warning",
                 showCancelButton: true,
                 confirmButtonColor: '#3085d6',
                 cancelButtonColor: '#d33',
                 confirmButtonText: 'Sim, atribuir!',
                 cancelButtonText: 'Cancelar',
             }).then(function(value) {
                 if (value.isConfirmed) {
                     form.submit(); // Success! 
                 } else {

                 }
             });
         }
     </script>
 @endsection
