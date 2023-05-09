import { HttpClient } from "@angular/common/http";
import { OnInit } from "@angular/core";
import { Router } from "@angular/router";

export class CellCustomComponent implements OnInit {
  params: any;
  constructor() {}

  agInit(params:any) {
    this.params = params;
  }

  ngOnInit() {}

  editRow() {
    let rowData = this.params;
    let i = rowData.rowIndex;
    return i;
  }

  viewRow() {
    let rowData = this.params;
    return rowData;
  }
}