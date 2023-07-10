<div class="modal-header">
      <h5 class="modal-title"><?php echo $titulo ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
      </button>
  </div>
<div class="row">
    <div class="col-md-12 p-5"> 
        <div class="col-md-8 float-left text-dark">
            <p class="subtitulos">OBLIGACIÓN</p>
            <p>Diligenciar y radicar el reporte de la informacion financiera</p>
        </div>
        <div class="col-md-4 float-left text-dark">
            <p class="subtitulos">FRECUENCIA</p>
            <p>Anual</p>
        </div>
    </div>
    <div class="col-md-12 pl-5">
        <div class="col-md-4 float-left text-dark">
            <p class="subtitulos">RESPONSABLE</p>
            <p>Gerencia de riesgo</p>
        </div>
        <div class="col-md-4 float-left text-dark">
            <p class="subtitulos">ENTIDAD</p>
            <p>Super intendencia de sociedades</p>
        </div>
        <div class="col-md-4 float-left text-dark">
            <p class="subtitulos">NORMA APLICABLE</p>
            <p>Artículo 70 ley 2069 de 2020</p>
        </div>
    </div>
    <div class="col-md-12 pl-5">
        <div class="col-md-8 float-left text-dark">
            <p class="subtitulos">DOCUMENTOS SOPORTE</p>
        </div>
        <div class="col-md-4 float-left text-dark">
            <p>Adjunte Documentos <a href="" title="Subir archivos"><i class="fas fa-file-upload" style="font-size: 30px;color:red;"></i></a> </p>
        </div>
    </div>
    <div class="col-md-12 pl-5 pr-5">
        <div class="documentos">
            <div class="col-md-12">
                <div class="col-md-6 float-left p-4">DOCUMENTO RESPALDO</div>
                <div class="col-md-4 float-left p-4">doc_gerencia.pdf</div>
                <div class="col-md-2 float-left p-4"><i class="fas fa-download down"></i></div>
                <div class="col-md-6 float-left p-4">INFORME</div>
                <div class="col-md-4 float-left p-4">informe.xlsx</div>
                <div class="col-md-2 float-left p-4"><i class="fas fa-download down"></i></div>
            </div>
        </div>
    </div>
    <div class="col-md-12 pl-5">
        <div class="col-md-8 float-left text-dark">
            <p class="subtitulos">OBSERVACIONES</p>
        </div>
    </div>
    <div class="col-md-12 pl-5 pr-5">
        <div class="col-md-12">
            <div class="form-group">
                <textarea class="form-control texarea" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
        </div>
    </div>
    <div class="col-md-12 pr-5">
        <button type="button" class="btn btn-danger">AGREGAR OBSERVACIÓN</button>
    </div>
</div>
<style>
    .subtitulos{font-size: 20px;}
    .documentos{height: auto; background-color:#F6F6F6;}
    .texarea{background-color: #F6F6F6; border:none;height: 97px;}
    button{position: relative; float: right; margin-bottom: 30px;}
    .down{font-size: 30px;color:#4D9B40;position: relative; float: right; right: -10px;}
</style>