 <div class="row ">
          <div class="col-12">
            <div class="card">
              <div class="card-header bg-primary d-flex align-items-center">
                <h3 class="card-title flex-grow-1"><i class="fa fa-truck"></i> Fournisseur : {{$fournisseur->nom}} {{$fournisseur->prenom}}</h3>

                <div class="card-tools d-flex align-items-center ">
                <a class="btn btn-link text-white mr-4 d-block"></a>
                  <div class="input-group input-group-md" style="width: 250px;">
                   
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0 table-striped" style="height: 300px;">
                <table class="table table-head-fixed">
                  <thead>
                    <tr>
                     <th style="width:10%;">Facture</th>
                      <th style="width:10%;">Montant </th>
                     <th style="width:20%;">Structure</th>
                      <th style="width:20%;" >Date Début</th>
                      <th style="width:20%;" class="text-center">Date Fin</th>
                       <th style="width:15%;" class="text-center">Etat</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                   @foreach($factures as $facture)
                    <tr>
                       <td>{{$facture->id }} </td>
                      <td>{{$facture->montant }} DA</td>
                      <td>{{$facture->structure->libelle}}</td>
                      <td><span class="tag tag-success">{{ $facture->dateDebut }}</span></td>
                       <td><span class="tag tag-success">{{$facture->dateFin }}</span></td>
                       <td>
                       @if($facture->etat == "0")
                            En cours 
                        @else
                           Cloturé
                        @endif
                        </td>
                     
                    </tr>
                    @endforeach
                </tbody>
                </table>
              </div>
                <!-- /.card-body -->
              <div class="card-footer">
                <div class="float-right">
                      <button type="button" class="btn btn-danger" wire:click="goToListFournisseur()">Retour</button>
                </div>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>