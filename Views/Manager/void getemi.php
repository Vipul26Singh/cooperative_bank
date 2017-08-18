void getemi()
{
//((P*R))/36500))*No of Days))

string s, e;
s = DisbursalDate;
e = FirstInstallementDate;
start = DateTime.ParseExact(s, "dd-MM-yyyy", CultureInfo.InvariantCulture);            
end = DateTime.ParseExact(e, "dd-MM-yyyy", CultureInfo.InvariantCulture);            
days = (int)(end - start).TotalDays;
float p;
p = amount;
outstanding = p;
interest = interestrate;
emi = EMI;


for (int i = 0; i < NoofInstallments; i++)
{
if (i < NoofInstallments - 1)
{
days = (int)(end - start).TotalDays;
outprincipal = outstanding;
intrestamount = ((outprincipal * interest) / 36500) * days;
intrestamount = (float)Math.Round(intrestamount, 2);
principal = emi - intrestamount;
principal = (float)Math.Round(principal, 2);
outstanding = outprincipal - principal;
outstanding = (float)Math.Round(outstanding, 2);
ds.emiInstall.Rows.Add(new object[] { (i + 1).ToString(), Convert.ToDateTime(end), outprincipal, emi, principal, intrestamount, outstanding });
start = end;
end = end.AddMonths(1);

}
else
{
days = (int)(end - start).TotalDays;
outprincipal = outstanding;
intrestamount = ((outprincipal * interest) / 36500) * days;
intrestamount = (float)Math.Round(intrestamount, 2);
principal = outprincipal;
principal = (float)Math.Round(principal, 2);
outstanding = outprincipal - principal;
outstanding = (float)Math.Round(outstanding, 2);
emi = principal + intrestamount;
emi = (float)Math.Round(emi, 2);
ds.emiInstall.Rows.Add(new object[] { (i + 1).ToString(), Convert.ToDateTime(end), outprincipal, emi, principal, intrestamount, outstanding });
}
}



}