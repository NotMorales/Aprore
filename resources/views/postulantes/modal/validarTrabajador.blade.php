<div class="modal fade" id="validarTrabajador" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Solicitar validación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Usted está por solicutar una aprobacion de este Postulante.</p>
                <h4>¿Desea continuar?</h4>
                <form id="form-validar-postulante" method="post" action="{{ route('postulante.solicitud.store', $postulante->id ) }}">
                    @csrf
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" form="form-validar-postulante">Solicitar</button>
            </div>
        </div>
    </div>
</div>
