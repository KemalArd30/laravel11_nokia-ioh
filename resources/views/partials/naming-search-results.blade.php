
      <div class="table-responsive">
          <table class="table table-nowrap">
              <thead>
                  <tr>
                      <th></th>
                      <th>Naming</th>
                      <th class="text-center">No</th>
                      <th class="text-center">Region</th>
                      <th class="text-center">System Key</th>
                      <th class="text-center">Site ID</th>
                      <th class="text-center">Site Name</th>
                      <th class="text-center">Phase Name</th>
                      <th class="text-center">Created At</th>
                      <th class="text-center">Last Update</th>
                      <th class="text-center">Action</th>
                  </tr>
              </thead>
              <tbody>
                  <?php $i = 1; ?>
                  @forelse ($dataFileNaming as $fileNaming)
                      <tr>
                          <td class="text-center">
                              <input type="checkbox" name="ids[]" value="{{ $fileNaming->id_sitelist }}" class="row-checkbox">
                          </td>
                          <td class="text-center"><button class="btn btn-link btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#details-{{ $fileNaming->id_sitelist }}" aria-expanded="false" aria-controls="details-{{ $fileNaming->id_sitelist }}">
                              <i class="fa-solid fa-caret-down"></i>
                            </button></td>
                            <td class="text-center">{{ ($dataFileNaming->currentPage() - 1) * $dataFileNaming->perPage() + $loop->iteration }}</td>
                          <td class="text-center">{{ $fileNaming->regional }}</td>
                          <td class="text-center">{{ $fileNaming->system_key }}</td>
                          <td class="text-center">{{ $fileNaming->site_id }}</td>
                          <td class="text-center">{{ $fileNaming->site_name }}</td>
                          <td class="text-center">{{ $fileNaming->phase_name }}</td>
                          <td class="text-center">{{ $fileNaming->created_at }}</td>
                          <td class="text-center">{{ $fileNaming->last_update }}</td>
                          <td class="text-center">
                              <a href="{{ url('filenaming/'.$fileNaming->id_sitelist.'/edit') }}">
                                  <i class="fa fa-edit"></i>
                              </a>
                          </td>
                      </tr>
                      <tr id="details-{{ $fileNaming->id_sitelist }}" class="collapse no-border-collapse">
                          <td colspan="15"> <!-- Sesuaikan jumlah kolom jika perlu -->
                              <div class="text-start" style="padding:5px;">
                                  <div class="row">
                                      <div class="col-lg-4 col-md-6 wrap-text">
                                          <strong>TSSR :</strong> {{ $fileNaming->tssr_file_naming }}
                                      </div>
                                      <div class="col-lg-4 col-md-6">
                                          <strong>SID :</strong> {{ $fileNaming->sid_file_naming }}
                                      </div>
                                      <div class="col-lg-4 col-md-6">
                                        <strong>NETGEAR :</strong> {{ $fileNaming->netgear_mos_file_naming }}
                                      </div>
                                      <div class="col-lg-4 col-md-6">
                                        <strong>LLD :</strong> {{ $fileNaming->lld_file_naming }}
                                      </div>
                                      <div class="col-lg-4 col-md-6">
                                          <strong>ABDW :</strong> {{ $fileNaming->abdw_file_naming }}
                                      </div>
                                      <div class="col-lg-4 col-md-6">
                                          <strong>ABDN :</strong> {{ $fileNaming->abdn_file_naming }}
                                      </div>
                                      <div class="col-lg-4 col-md-6">
                                        <strong>BOQ :</strong> {{ $fileNaming->boq_file_naming }}
                                      </div>
                                      <div class="col-lg-4 col-md-6">
                                        <strong>ATF :</strong> {{ $fileNaming->atf_file_naming }}
                                      </div>
                                      <div class="col-lg-4 col-md-6">
                                        <strong>ATP :</strong> {{ $fileNaming->atp_file_naming }}
                                    </div>
                                  </div>
                              </div>
                          </td>
                      </tr>
                      <?php $i++; ?>
                  @empty
                      <tr>
                          <td colspan="20" class="text-center">Tidak ada data yang tersedia.</td>
                      </tr>
                  @endforelse
              </tbody>
          </table>
      </div>
      <div class="p-2">
        {{ $dataFileNaming->appends(request()->except('page'))->links() }}
        </div>