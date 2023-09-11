<x-mail::message>
    # Relatório diário

    Total de vendas realizada em {{(new \DateTime())->format('d/m/Y')}}

    Vendas: {{ number_format($sales, 2, ',', '.') }}
    Comissão: {{ number_format($commission, 2, ',', '.') }}

    Obrigado,
</x-mail::message>