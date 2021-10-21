<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-sm-12">
                <h3 style="">Aportes en línea rápidos y seguros</h3>
                <p>Ahora puedes hacer tus aportes mensuales correspondientes a la cuota de tu Plan de Ahorro ingresando a nuestra plataforma de pagos en línea.</p>
            </div>
            <div class="col-lg-2 col-sm-12">
                <a href="https://www.pse.com.co/persona" target="_blank">
                    <img class="img-fluid mx-auto d-block" src="https://eca.edu.co/wp-content/uploads/2020/04/logo-pse-300x300.png" alt="PSE Logo">
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p class="notify">Debido a la emergencia por la que atraviesa el país, te informamos que podrás realizar tus aportes mensuales, a través de tarjetas de crédito. (Estará disponible hasta nuestra próxima Ceremonia de Sueños).<p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-sm-12">
                <form action="check-payments" id="payments-form">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <label for="doctype">Tipo de documento</label>
                            <select class="form-control" name="doctype" id="doctype">
                                <option value="">Tipo de documento</option>
                                @foreach ($doc_types as $doc_type)
                                    <option value="{{ $doc_type->id }}">{{ $doc_type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <label for="docnum">Número de documento</label>
                            <input type="text" class="form-control" name="docnum" id="docnum" placeholder="Ingresar Número de documento" autocomplete="off">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-3">
                            <button type="submit" class="btn btn-danger float-right">Consultar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="results-container" class="row mt-3 justify-content-center" style="display:none">
            <div class="container">
                <div class="col-auto">
                    <h3 id="client-name"></h3>
                    <table class="table table-center table-responsive table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Número de plan</th>
                                <th scope="col">Valor de cuota</th>
                                <th scope="col">Vencimiento</th>
                                <th scope="col">Vigencia</th>
                            </tr>
                        </thead>
                        <tbody id="results"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/popper.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jquery-validate.bootstrap-tooltip.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/localization/messages_es.min.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/main.js')}}"></script>
</body>
</html>
