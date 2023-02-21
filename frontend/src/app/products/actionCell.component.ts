import { HttpClient } from "@angular/common/http";
import { OnInit } from "@angular/core";
import { Router } from "@angular/router";

export class CellCustomComponent implements OnInit {
  data: any;
  params: any;
  constructor(private http: HttpClient, private router: Router) {}

  agInit(params:any) {
    this.params = params;
    this.data = params.value;
  }

  ngOnInit() {}

  editRow() {
    let rowData = this.params;
    let i = rowData.rowIndex;
  }

  viewRow() {
    let rowData = this.params;
  }
}